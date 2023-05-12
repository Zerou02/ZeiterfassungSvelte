type SectionNr = "1" | "101" | "150" | "200" | "250";

type ParsedData = {
  [key in SectionNr]: string[];
};

interface Config {
  serverPath: string;
}
