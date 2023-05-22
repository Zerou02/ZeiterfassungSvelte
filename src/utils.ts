import { Ball } from "./Ball";
import { screenSize } from "./globals";

export const getRandNr = (lower: number, upper: number) => {
  return Math.random() * upper + lower;
};

export const getRandDirection = () => {
  let direction = getRandNr(0, 1);
  let signed = getRandNr(0, 1) > 0.5;
  return signed ? direction : -direction;
};

export const normalizeVector = (vec: Vector2): Vector2 => {
  let length = Math.sqrt(vec.x * vec.x + vec.y * vec.y);
  return { x: vec.x / length, y: vec.y / length };
};

export const getRandomBall = () => {
  return getBallAtPos(getRandNr(0, screenSize.x), getRandNr(0, screenSize.y));
};

export const getBallAtPos = (x: number, y: number) => {
  let directionVec = {
    x: getRandDirection(),
    y: getRandDirection(),
  };
  return new Ball(
    x,
    y,
    getRandNr(10, 20),
    getRandNr(0.5, 1),
    normalizeVector(directionVec)
  );
};
