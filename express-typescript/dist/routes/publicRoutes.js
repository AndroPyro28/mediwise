"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = require("express");
const publicController_1 = __importDefault(require("../controller/publicController"));
const middleware_1 = __importDefault(require("../middleware/middleware"));
const router = (0, express_1.Router)();
const { middleFunction } = new middleware_1.default();
const controller = new publicController_1.default();
router.get('/', middleFunction, controller.indexController);
router.post('/post', middleFunction, controller.someController);
exports.default = router;
