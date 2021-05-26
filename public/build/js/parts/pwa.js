if ('serviceWorker' in navigator) {
    var deferredPrompt;
    var addBtn = document.querySelector('#btn-add-to-home-screen');
    var notificationSubscriptionBtn = document.querySelector('.news-btn');
    var versionContainer = document.querySelector('.controller_main');
    var version = versionContainer.getAttribute('data-version');
    navigator.serviceWorker
        .register('/sw.js?ver=' + version, {scope: "/"})
        .then(function () {
            console.log('SW registered!');
        });
    window.addEventListener('beforeinstallprompt', function (e) {
        console.log("beforeinstallprompt, installable");
        // Prevent Chrome 67 and earlier from automatically showing the prompt
        e.preventDefault();
        // Stash the event so it can be triggered later.
        deferredPrompt = e;
        // Update UI to notify the user they can add to home screen
        addBtn.style.display = 'block';
        addBtn.addEventListener('click', function (e) {
            // hide our user interface that shows our A2HS button
            addBtn.style.display = 'none';
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
    });

    function displayConfirmNotification() {
        if ('serviceWorker' in navigator) {
            var options = {
                body: 'You successfully subscribed to our Notification service!',
                icon: '/public/build/images/icons/icon-96x96.png',
                image: '/public/build/images/icons/icon-256x256.png',
                dir: 'ltr',
                lang: 'en-US', // BCP 47,
                vibrate: [100, 50, 200],
                badge: '/public/build/images/icons/icon-96x96.png',
                tag: 'confirm-notification',
                renotify: true,
                actions: [
                    {action: 'confirm', title: 'Okay', icon: '/public/build/images/icons/icon-96x96.png'},
                    {action: 'cancel', title: 'Cancel', icon: '/public/build/images/icons/icon-96x96.png'}
                ]
            };

            navigator.serviceWorker.ready
                .then(function (swreg) {
                    swreg.showNotification('Successfully subscribed!', options);
                });
        }
    }

    function configurePushSub() {
        var reg;
        navigator.serviceWorker.ready
            .then(function (swreg) {
                reg = swreg;
                return swreg.pushManager.getSubscription();
            })
            .then(function (sub) {
                if (sub === null) {
                    // Create a new subscription
                    var vapidPublicKey = 'BD2JY9S9yYiasakRQnyOvHb5vbQ3zgMhIC6wABWXv2J2gHlfprAZ7ovBSOFm0I6DECDbQmX21tUsYGgW31AFeWg';
                    var convertedVapidPublicKey = urlBase64ToUint8Array(vapidPublicKey);
                    return reg.pushManager.subscribe({
                        userVisibleOnly: true,
                        applicationServerKey: convertedVapidPublicKey
                    });
                } else {
                    // We have a subscription
                }
            })
            .then(function (newSub) {
                console.log('newSub', newSub);
                return fetch('https://quickstart-1601993978019-default-rtdb.europe-west1.firebasedatabase.app/subscriptions.json', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(newSub)
                })
                    .catch(function (err) {
                        console.log(err);
                    });
            })
            .then(function (res) {
                if (res.ok) {
                    displayConfirmNotification();
                }
            })
            .catch(function (err) {
                console.log(err);
            });
    }

    function askForNotificationPermission() {
        Notification.requestPermission(function (result) {
            console.log('User Choice', result);
            if (result !== 'granted') {
                console.log('No notification permission granted!');
            } else {
                configurePushSub();
            }
        });
    }

    if ('Notification' in window && 'serviceWorker' in navigator) {
        notificationSubscriptionBtn.addEventListener('click', function (e) {
            askForNotificationPermission();
        });
    }
}