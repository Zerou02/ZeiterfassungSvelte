type SectionNr = "1" | "101" | "150" | "200" | "250";

type ParsedData = {
  [key in SectionNr]: string[];
};

type TableParsedData = ParsedColumn[];
type ParsedColumn = string[];

interface Config {
  serverPath: string;
  env: "dev" | "prod";
  seeAll: boolean;
  debug: boolean;
}

interface Vector2 {
  x: number;
  y: number;
}
