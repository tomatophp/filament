// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js');

try
{
    // Initialize the Firebase app in the service worker by passing in
    // your app's Firebase config object.
    // https://firebase.google.com/docs/web/setup#config-object
    firebase.initializeApp({
        apiKey: "AIzaSyBHM0qQcP5p47u7eTKnKCnyzNP6d1eQslQ",
        authDomain: "x1io-309101.firebaseapp.com",
        databaseURL: "https://x1io-309101-default-rtdb.firebaseio.com",
        projectId: "x1io-309101",
        storageBucket: "x1io-309101.appspot.com",
        messagingSenderId: "926924779977",
        appId: "1:926924779977:web:8e96e6ac385207b7733818",
        measurementId: "G-LVRRBBLBJM"
    });


    // Retrieve an instance of Firebase Messaging so that it can handle background
    // messages.
    const messaging = firebase.messaging();

    messaging.onBackgroundMessage((payload) => {
    //


        let options = {
            body: "",
            icon: "",
            image: "",
            tag: "alert",
        };

        if(payload.data.body){
            options.body = payload.data.body;
        }

        if(payload.data.image){
            options.icon = payload.data.image;
        }

        let notification = self.registration.showNotification(
            payload.data.title,
            options
        );

        if(payload.data.url){
            // link to page on clicking the notification
            notification.onclick = (payload) => {
                window.open(payload.data.url);
            };
        }
    });
}
catch(e) {
    console.log(e)
}
