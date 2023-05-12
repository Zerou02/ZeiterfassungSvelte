import { writable } from "svelte/store";

let defaultConf: Config = { serverPath: "" };
export const config = writable(defaultConf);
