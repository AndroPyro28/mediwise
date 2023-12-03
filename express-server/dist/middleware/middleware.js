"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const addNumber = (rest) => {
    return rest.reduce((total, number) => total + number, 0);
};
class MiddleWare {
    constructor() {
        this.middleFunction = (req, res, next) => {
            try {
                req.addNumbers = addNumber([1, 2, 3, 4, 5]);
                next();
            }
            catch (error) {
                console.log(error.message);
            }
        };
    }
}
exports.default = MiddleWare;
