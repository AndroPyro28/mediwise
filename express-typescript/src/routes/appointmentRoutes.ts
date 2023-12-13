import {Router} from "express";
import AppointmentController from "../controller/appointmentController";
import MiddleWare from "../middleware/middleware";

const router: Router = Router();
const {middleFunction} = new MiddleWare();

const controller = new AppointmentController()

router.post('/', middleFunction, controller.create);
router.get('/', middleFunction, controller.getAll);
router.get('/get-history-doctor/:id', controller.getHistoryByDoctor);
router.get('/history', middleFunction, controller.getHistoryAppointment);
router.post('/getAppointmentSlots', middleFunction, controller.getSlot);
router.patch('/', controller.updateStatus);
router.delete('/:id', controller.deleteStatus);

export default router;

// get-history-doctor/${user_id}