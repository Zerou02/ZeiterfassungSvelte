import { writable } from "svelte/store";

let defaultConf: Config = {
  serverPath: "",
  debug: false,
  env: "prod",
  seeAll: false,
};
export const config = writable(defaultConf);
