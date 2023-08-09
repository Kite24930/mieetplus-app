// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyDwZcqM4hEEhm5BKDuClp1_g6pTUjXirYA",
    authDomain: "mieet-plus.firebaseapp.com",
    projectId: "mieet-plus",
    storageBucket: "mieet-plus.appspot.com",
    messagingSenderId: "1009772432371",
    appId: "1:1009772432371:web:b895d131b2ef1050b1a086",
    measurementId: "G-5FQ9G2FZBW"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

export { app, analytics }
