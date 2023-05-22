export const gSectionNameMap = {
  1: "Verwaltung",
  101: "Lettershop",
  150: "Logistik",
  200: "Industrie",
  250: "BuBi",
};

export let screenSize = { x: 0, y: 0 };

export const setScreenSize = (x: number, y: number) => {
  screenSize.x = x;
  screenSize.y = y;
};
