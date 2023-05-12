export type SectionNr = "1" | "101" | "150" | "200" | "250";
export type SectionName = "B" | "u" | "B" | "i" | "s";

export const SectionNrNameMap: { [key in SectionNr]: SectionName } = {
  1: "B",
  101: "u",
  150: "B",
  200: "i",
  250: "s",
};

export type ParsedData = {
  [key in SectionNr]: string[];
};

interface Config {
  serverPath: string;
}
