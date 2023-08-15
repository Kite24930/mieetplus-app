import { Loader } from "@googlemaps/js-api-loader";

const loader = new Loader({
    apiKey: "AIzaSyBqg9kC120TE5bjHzJITW11xWAtbY9Usk4",
    version: "weekly",
    libraries: ["places"],
});

export { loader };
