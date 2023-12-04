"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const publicRoutes_1 = __importDefault(require("./routes/publicRoutes"));
const app = (0, express_1.default)();
app.use(express_1.default.json());
app.use('/', publicRoutes_1.default);
app.listen(3000, () => console.log('server starts at port 3000'));
