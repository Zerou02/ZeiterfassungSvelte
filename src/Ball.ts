import { screenSize } from "./globals";

export class Ball {
  x: number;
  y: number;
  radius: number;
  velocity: number;
  direction: Vector2;

  toDestroy: boolean;
  alreadyCollided: boolean;
  constructor(
    x: number,
    y: number,
    radius: number,
    velocity: number,
    direction: Vector2
  ) {
    this.x = x;
    this.y = y;
    this.radius = radius;
    this.velocity = velocity;
    this.direction = direction;
    this.toDestroy = false;
    this.alreadyCollided = false;
  }

  draw(ctx: CanvasRenderingContext2D) {
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.radius - 1, 0, 360);
    ctx.fill();
    ctx.arc(this.x, this.y, this.radius, 0, 360);
    ctx.stroke();
  }

  move() {
    this.x += this.velocity * this.direction.x;
    this.y += this.velocity * this.direction.y;
    if (
      this.x - this.radius > screenSize.x ||
      this.x - this.radius < 0 ||
      this.y - this.radius > screenSize.y ||
      this.y - this.radius < 0
    ) {
      this.toDestroy = true;
    }
  }

  isColliding(ball: Ball) {
    const dx = this.x - ball.x;
    const dy = this.y - ball.y;
    const distance = Math.sqrt(dx * dx + dy * dy);

    return distance < this.radius + ball.radius;
  }

  handleCollision(ball: Ball) {
    if (this.isColliding(ball) && !this.alreadyCollided) {
      let tmpVel = this.velocity;
      let tmpDir = this.direction;
      this.direction = ball.direction;
      this.velocity = ball.velocity;
      ball.velocity = tmpVel;
      ball.direction = tmpDir;
      this.alreadyCollided = true;
      ball.alreadyCollided = true;
    }
  }
}
