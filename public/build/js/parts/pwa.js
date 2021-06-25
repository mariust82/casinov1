if ('serviceWorker' in navigator) {
    var deferredPrompt;
    var siteId = 'cl';
    var defaultTimeOut = 10000;
    var versionContainer = document.querySelector('.controller_main');
    var version = versionContainer.getAttribute('data-version');
    var vapidPublicKey = 'BD2JY9S9yYiasakRQnyOvHb5vbQ3zgMhIC6wABWXv2J2gHlfprAZ7ovBSOFm0I6DECDbQmX21tUsYGgW31AFeWg';
    var fbUrl = 'https://quickstart-1601993978019-default-rtdb.europe-west1.firebasedatabase.app';

    function getDateInfo() {
        return {
            timeZone: new Date().getTimezoneOffset() / -60,
            timeZoneName: Intl.DateTimeFormat().resolvedOptions().timeZone,
            timeZoneTitle: new Date().toTimeString().slice(9)
        }
    }

    navigator.serviceWorker.register('/sw.js?ver=' + version, {scope: "./"})
        .then(() => console.log('serviceWorker registered'))
        .catch((err) => console.log('serviceWorker registration failed: ', err));

    var pwaPopup = document.querySelector('.pwa-popup');
    if (pwaPopup && !localStorage.getItem('isA2HSAccepted')) {
        var A2HSBtn = document.querySelector('#btn-add-to-home-screen');
        var closeA2HSPopup = document.querySelector('.pwa-popup_close-home-screen');
        var notAgainA2HSPopup = document.querySelector('.pwa-popup_not-again');

        function showA2HSPopup() {
            if (!sessionStorage.getItem('isA2HSPopupClosed') &&
                !localStorage.getItem('isA2HSPopupClosed')) {
                pwaPopup.style.display = 'block';
            }
        }

        function hideA2HSPopup(isSession) {
            pwaPopup.style.display = 'none';
            if (isSession) {
                sessionStorage.setItem('isA2HSPopupClosed', true);
            } else {
                localStorage.setItem('isA2HSPopupClosed', true);
            }
        }

        closeA2HSPopup.addEventListener('click', function () {
            hideA2HSPopup(true);
        });
        notAgainA2HSPopup.addEventListener('click', function () {
            hideA2HSPopup(false);
        });
        window.addEventListener('beforeinstallprompt', function (e) {
            // Prevent Chrome 67 and earlier from automatically showing the prompt
            e.preventDefault();
            e.stopPropagation();
            console.log('PWA is installable.');
            // Stash the event so it can be triggered later.
            deferredPrompt = e;
            // Update UI to notify the user they can add to home screen
            setTimeout(function () {
                showA2HSPopup();
            }, defaultTimeOut)
            A2HSBtn.addEventListener('click', function (e) {
                console.log('Adding to Home Screen');
                // hide our user interface that shows our A2HS button
                pwaPopup.style.display = 'none';
                // Show the prompt
                deferredPrompt.prompt();
                // Wait for the user to respond to the prompt
                deferredPrompt.userChoice.then(function (choiceResult) {
                    if (choiceResult.outcome === 'accepted') {
                        localStorage.setItem('isA2HSAccepted', true);
                        console.log('User accepted the A2HS prompt');
                    } else {
                        console.log('User dismissed the A2HS prompt');
                    }
                    deferredPrompt = null;
                });
            });

            return false;
        });
    }

    var pwaNotificationPopup = document.querySelector('.pwa-popup-notification');
    if (pwaNotificationPopup && 'Notification' in window && localStorage.getItem('isA2HSAccepted')) {
        var notificationSubscriptionBtn = document.querySelector('#btn-allow-notifications');
        var closeNotificationPopupBtn = document.querySelector('.pwa-popup_close-notification');
        var noThanksBtn = document.querySelector('.pwa-popup_no-thanks');

        function showNotificationPopup() {
            if (!sessionStorage.getItem('isNotificationPopupClosed') &&
                !localStorage.getItem('isNotificationPopupClosed') &&
                !localStorage.getItem('isNotificationAccepted')
            ) {
                pwaNotificationPopup.style.display = 'block';
            }
        }

        function hideNotificationPopup(isSession) {
            pwaNotificationPopup.style.display = 'none';
            if (isSession) {
                sessionStorage.setItem('isNotificationPopupClosed', true);
            } else {
                localStorage.setItem('isNotificationPopupClosed', true);
            }
        }

        closeNotificationPopupBtn.addEventListener('click', function () {
            hideNotificationPopup(false);
        });
        noThanksBtn.addEventListener('click', function () {
            hideNotificationPopup(true);
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
                    {action: 'confirm', title: 'Okay', icon: '/public/build/images/icons/icon-96x96.png'}
                ]
            };
            notificationSubscriptionBtn.style.display = 'none';
            navigator.serviceWorker.ready
                .then(function (swRegistration) {
                    localStorage.setItem('isNotificationAccepted', true);
                    swRegistration.showNotification('Successfully subscribed!', options);
                });
        }

        function configurePushSubscription() {
            var swrPushManager;
            navigator.serviceWorker.ready
                .then(function (swReg) {
                    if (!swReg || !('pushManager' in swReg)) {
                        console.log('ServiceWorkerRegistration failed...', swReg);
                        return null;
                    } else {
                        swrPushManager = swReg.pushManager;
                        return swrPushManager.getSubscription();
                    }
                })
                .then(function (pushSubscription) {
                    if (!pushSubscription) {
                        return null;
                    } else {
                        // Create a new subscription
                        return swrPushManager.subscribe({
                            userVisibleOnly: true,
                            applicationServerKey: urlBase64ToUint8Array(vapidPublicKey)
                        });
                    }
                })
                .then(function (newPushSubscription) {
                    if (!newPushSubscription) {
                        return null;
                    } else {
                        var fbDocument = JSON.stringify({
                            date: getDateInfo(),
                            siteId: siteId,
                            subscriptionInfo: newPushSubscription,
                        });
                        return fetch(fbUrl + '/subscriptions.json', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: fbDocument
                        })
                            .catch(function (err) {
                                console.log(err);
                            });
                    }
                })
                .then(function (res) {
                    if (res && res.ok) {
                        displayConfirmNotification();
                    } else {
                        alert("Something went wrong with subscription");
                    }
                })
                .catch(function (err) {
                    console.log(err);
                });
        }

        function askForNotificationPermission() {
            Notification.requestPermission(function (result) {
                if (result !== 'granted') {
                    console.log('No notification permission granted!');
                } else {
                    configurePushSubscription();
                }
            });
        }

        notificationSubscriptionBtn.addEventListener('click', function (e) {
            askForNotificationPermission();
        });
    } else {
        console.log("'Notification' not in window, or pwa-popup-notification doesn't existing.");
    }
} else {
    console.log("'serviceWorker' not in navigator");
}