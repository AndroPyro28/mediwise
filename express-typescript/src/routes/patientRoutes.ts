import {Router} from "express";
import PatientController from "../controller/patientController";
import MiddleWare from "../middleware/middleware";

const router: Router = Router();

const {middleFunction} = new MiddleWare();

const controller = new PatientController()

router.get('/getDataForDashboard', controller.getDataForDashboard);
export default router;