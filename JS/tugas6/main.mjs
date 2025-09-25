import { index, store, destroy } from "./controller.mjs";
import user from "./data.mjs";

const main = () => {
    index()
    console.log("______________________")
    store(user);
    console.log("______________________")
    index()
    console.log("______________________")
    destroy("Budi")
    
    index()
}

main()