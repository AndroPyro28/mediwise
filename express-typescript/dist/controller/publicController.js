"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const connectDb_1 = __importDefault(require("../config/connectDb"));
const class_validator_1 = require("class-validator");
const ValidateClass_1 = require("../classes/ValidateClass");
class PublicController {
    constructor() {
        this.indexController = (req, res) => __awaiter(this, void 0, void 0, function* () {
            const [result, _] = yield connectDb_1.default.execute('INSERT INTO ts (username, password) VALUES (?, ?)', ['jean', '456']);
            req.addNumbers;
            console.log(result);
            res.status(200).json({ name: 'andro', age: 50 });
        });
        this.someController = (req, res) => __awaiter(this, void 0, void 0, function* () {
            const validateClass = new ValidateClass_1.ValidateClass(req.body);
            (0, class_validator_1.validateOrReject)(validateClass)
                .then(good => {
                console.log('yes');
                console.log(good);
            })
                .catch(bad => {
                console.log('no');
                console.log(bad);
            });
        });
    }
}
exports.default = PublicController;
