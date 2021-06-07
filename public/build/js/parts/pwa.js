if ('serviceWorker' in navigator) {
    var deferredPrompt;
    var siteId = 'cl';
    var addToHomeScreenBtn = document.querySelector('#btn-add-to-home-screen');
    var notificationSubscriptionBtn = document.querySelector('.news-btn');
    var versionContainer = document.querySelector('.controller_main');
    var version = versionContainer.getAttribute('data-version');
    var vapidPublicKey = 'BD2JY9S9yYiasakRQnyOvHb5vbQ3zgMhIC6wABWXv2J2gHlfprAZ7ovBSOFm0I6DECDbQmX21tUsYGgW31AFeWg';
    var fbUrl = 'https://quickstart-1601993978019-default-rtdb.europe-west1.firebasedatabase.app';

    navigator.serviceWorker.register('/sw.js?ver=' + version, {scope: "/"});

    window.addEventListener('beforeinstallprompt', function (e) {
        console.log("beforeinstallprompt, installable");
        // Prevent Chrome 67 and earlier from automatically showing the prompt
        e.preventDefault();
        // Stash the event so it can be triggered later.
        deferredPrompt = e;
        // Update UI to notify the user they can add to home screen
        addToHomeScreenBtn.style.display = 'block';
        addToHomeScreenBtn.addEventListener('click', function (e) {
            // hide our user interface that shows our A2HS button
            addToHomeScreenBtn.style.display = 'none';
            // Show the prompt
            deferredPrompt.prompt();
            // Wait for the user to respond to the prompt
            deferredPrompt.userChoice.then(function (choiceResult) {
                if (choiceResult.outcome === 'accepted') {
                    console.log('User accepted the A2HS prompt');
                } else {
                    console.log('User dismissed the A2HS prompt');
                }
                deferredPrompt = null;
            });
        });

        return false;
    });

    function getDateInfo() {
        return {
            timeZone: new Date().getTimezoneOffset() / -60,
            timeZoneName: Intl.DateTimeFormat().resolvedOptions().timeZone,
            timeZoneTitle: new Date().toTimeString().slice(9)
        }
    }

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
                swRegistration.showNotification('Successfully subscribed!', options);
            });
    }

    function configurePushSubscription() {
        var swRegistration;
        navigator.serviceWorker.ready
            .then(function (swReg) {
                swRegistration = swReg;
                return swRegistration.pushManager.getSubscription();
            })
            .then(function (pushSubscription) {
                if (pushSubscription === null) {
                    // Create a new subscription
                    var convertedVapidPublicKey = urlBase64ToUint8Array(vapidPublicKey);
                    return swRegistration.pushManager.subscribe({
                        userVisibleOnly: true,
                        applicationServerKey: convertedVapidPublicKey
                    });
                } else {
                    return null;
                }
            })
            .then(function (newPushSubscription) {
                if (newPushSubscription) {
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

    if ('Notification' in window) {
        notificationSubscriptionBtn.addEventListener('click', function (e) {
            askForNotificationPermission();
        });
    }
}