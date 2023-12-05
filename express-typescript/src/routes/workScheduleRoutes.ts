import {Router} from "express";
import workSchedule from '../controller/workScheduleController';

import MiddleWare from "../middleware/middleware";

const router: Router = Router();
const controller = new workSchedule()

router.post('/', controller.create);
router.get('/getWorkSchedules', controller.get);
router.post('/getWorkSchedulesForUser', controller.getAllWorkHours);

export default router;