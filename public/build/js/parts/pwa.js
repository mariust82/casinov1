function getMobileOperatingSystem() {
    var userAgent = navigator.userAgent || navigator.vendor || window.opera;
    if (/android/i.test(userAgent)) {
        return 'android';
    }
    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        return 'ios';
    }

    return 'unknown';
}

var mobileOperatingSystem = getMobileOperatingSystem();
if (mobileOperatingSystem !== 'unknown') {
    var deferredPrompt;
    var defaultTimeOut = 10000;
    var versionContainer = document.querySelector('.controller_main');
    var version = versionContainer.getAttribute('data-version');
    var vapidPublicKey = 'BD2JY9S9yYiasakRQnyOvHb5vbQ3zgMhIC6wABWXv2J2gHlfprAZ7ovBSOFm0I6DECDbQmX21tUsYGgW31AFeWg';
    var fbUrl = 'https://casinoslists-default-rtdb.firebaseio.com';

    function getDateInfo() {
        return {
            timeZone: new Date().getTimezoneOffset() / -60,
            timeZoneName: Intl.DateTimeFormat().resolvedOptions().timeZone,
            timeZoneTitle: new Date().toTimeString().slice(9)
        }
    }

    function isPWAInstalled() {
        var displays = ["fullscreen", "standalone", "minimal-ui"];
        return navigator.standalone || displays.some(function (displayMode) {
            return window.matchMedia('(display-mode: ' + displayMode + ')').matches;
        });
    }

    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js?ver=' + version);
    }

    fetch('/pwa-popups?device=' + mobileOperatingSystem)
        .then(function (response) {
            return response.ok ? response.text() : null;
        })
        .then(function (html) {
            if (html) {
                $('body').append(html.replace('<head/>', ''));
                return true;
            } else {
                return false;
            }
        })
        .then(function (isAppended) {
            if (isAppended) {
                alert("Popup appended");
                var pwaInstallationPopup = document.querySelector('.pwa-popup-installation');
                if (pwaInstallationPopup && !localStorage.getItem('isA2HSAccepted')) {
                    alert("Popup existing and can be triggered..");
                    var A2HSBtn = document.querySelector('#btn-add-to-home-screen');
                    var closeA2HSPopupBtn = document.querySelector('.pwa-popup_close-home-screen');
                    var installationDeclinedBtn = document.querySelector('.pwa-popup_installation-declined');

                    function showA2HSPopup() {
                        alert("Triggered");
                        if (!sessionStorage.getItem('isA2HSPopupClosed') &&
                            !localStorage.getItem('isA2HSPopupClosed')) {
                            setTimeout(function () {
                                alert("After timeout Triggered");
                                pwaInstallationPopup.style.display = 'block';
                            }, defaultTimeOut);
                        }
                    }

                    function setA2HSState(state) {
                        if (state === 'installed') {
                            localStorage.setItem('isA2HSAccepted', true);
                        } else if (state === 'session') {
                            sessionStorage.setItem('isA2HSPopupClosed', true);
                        } else if (state === 'local') {
                            localStorage.setItem('isA2HSPopupClosed', true);
                        }
                    }

                    function hideA2HSPopup() {
                        pwaInstallationPopup.style.display = 'none';
                    }

                    closeA2HSPopupBtn.addEventListener('click', function () {
                        hideA2HSPopup();
                        setA2HSState('session');
                    });
                    installationDeclinedBtn.addEventListener('click', function () {
                        hideA2HSPopup();
                        setA2HSState('local');
                    });
                    if (mobileOperatingSystem === 'ios' && !isPWAInstalled()) {
                        alert("Popup starting")
                        showA2HSPopup();
                    }
                    window.addEventListener('appinstalled', function () {
                        setA2HSState('installed');
                        // Clear the deferredPrompt so it can be garbage collected
                        deferredPrompt = null;
                    });
                    window.addEventListener('beforeinstallprompt', function (e) {
                        // Prevent Chrome 67 and earlier from automatically showing the prompt
                        e.preventDefault();
                        e.stopPropagation();
                        // Stash the event so it can be triggered later.
                        deferredPrompt = e;
                        // Update UI to notify the user they can add to home screen
                        showA2HSPopup();
                        if (A2HSBtn) {
                            A2HSBtn.addEventListener('click', function (e) {
                                hideA2HSPopup();
                                // Show the prompt
                                deferredPrompt.prompt();
                                // Wait for the user to respond to the prompt
                                deferredPrompt.userChoice.then(function (choiceResult) {
                                    if (choiceResult.outcome === 'accepted') {
                                        setA2HSState('installed');
                                    }
                                    deferredPrompt = null;
                                });
                            });
                        }

                        return false;
                    });
                }

                var pwaNotificationPopup = document.querySelector('.pwa-popup-notification');
                if (pwaNotificationPopup &&
                    'Notification' in window &&
                    localStorage.getItem('isA2HSAccepted') &&
                    !localStorage.getItem('isNotificationAccepted')) {
                    var notificationSubscriptionBtn = document.querySelector('#btn-allow-notifications');
                    var closeNotificationPopupBtn = document.querySelector('.pwa-popup_close-notification');
                    var notificationsDeclinedBtn = document.querySelector('.pwa-popup_notifications-declined');

                    function showNotificationPopup() {
                        if (!sessionStorage.getItem('isNotificationPopupClosed') &&
                            !localStorage.getItem('isNotificationPopupClosed')) {
                            pwaNotificationPopup.style.display = 'block';
                        }
                    }

                    function setNotificationState(state) {
                        if (state === 'accepted') {
                            localStorage.setItem('isNotificationAccepted', true);
                        } else if (state === 'session') {
                            sessionStorage.setItem('isNotificationPopupClosed', true);
                        } else if (state === 'local') {
                            localStorage.setItem('isNotificationPopupClosed', true);
                        }
                    }

                    function hideNotificationPopup() {
                        pwaNotificationPopup.style.display = 'none';
                    }

                    closeNotificationPopupBtn.addEventListener('click', function () {
                        hideNotificationPopup();
                        setNotificationState('session');
                    });
                    notificationsDeclinedBtn.addEventListener('click', function () {
                        hideNotificationPopup();
                        setNotificationState('local');
                    });

                    setTimeout(function () {
                        showNotificationPopup();
                    }, defaultTimeOut)

                    function displayConfirmNotification() {
                        var options = {
                            body: 'You successfully subscribed to our Notification service!',
                            icon: '/public/build/images/icons/icon-96x96.png',
                            image: '/public/build/images/icons/icon-256x256.png',
                            dir: 'ltr',
                            lang: 'en-US',
                            vibrate: [100, 50, 200],
                            badge: '/public/build/images/icons/icon-96x96.png',
                            tag: 'confirm-notification',
                            renotify: true,
                            data: {
                                url: '/'
                            },
                            actions: [
                                {
                                    action: 'confirm',
                                    title: 'Okay',
                                    icon: '/public/build/images/icons/icon-96x96.png'
                                }
                            ]
                        };
                        navigator.serviceWorker.ready
                            .then(function (swRegistration) {
                                hideNotificationPopup();
                                setNotificationState('accepted');
                                swRegistration.showNotification('Successfully subscribed!', options);
                            });
                    }

                    function configurePushSubscription() {
                        var serviceWorkedRegistration;
                        navigator.serviceWorker.ready
                            .then(function (swReg) {
                                if (swReg && 'pushManager' in swReg) {
                                    serviceWorkedRegistration = swReg;
                                    return swReg.pushManager.getSubscription();
                                } else {
                                    return false;
                                }
                            })
                            .then(function (pushSubscription) {
                                if (pushSubscription === null) {
                                    // Create a new subscription
                                    return serviceWorkedRegistration.pushManager.subscribe({
                                        userVisibleOnly: true,
                                        applicationServerKey: urlBase64ToUint8Array(vapidPublicKey)
                                    });
                                } else {
                                    return null;
                                }
                            })
                            .then(function (newPushSubscription) {
                                if (newPushSubscription) {
                                    var fbDocument = JSON.stringify({
                                        date: getDateInfo(),
                                        subscriptionInfo: newPushSubscription,
                                    });
                                    return fetch(fbUrl + '/subscriptions.json', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'Accept': 'application/json'
                                        },
                                        body: fbDocument
                                    });
                                } else {
                                    return null;
                                }
                            })
                            .then(function (res) {
                                if (res && res.ok) {
                                    displayConfirmNotification();
                                }
                            });
                    }

                    function askForNotificationPermission() {
                        Notification.requestPermission(function (result) {
                            if (result === 'granted') {
                                configurePushSubscription();
                            }
                        });
                    }

                    notificationSubscriptionBtn.addEventListener('click', function (e) {
                        hideNotificationPopup();
                        askForNotificationPermission();
                    });
                }
            }
        });
}