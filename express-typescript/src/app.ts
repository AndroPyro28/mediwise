import express, {Request, Response, NextFunction, Application} from 'express';
import publicRoutes from './routes/publicRoutes'
import appointmentRoutes from './routes/appointmentRoutes'
import doctorRoutes from './routes/doctorRoutes'
import inventoryRoutes from './routes/inventoryRoutes'
import patientRoutes from './routes/patientRoutes'
import workScheduleRoutes from './routes/workScheduleRoutes'
import cors from 'cors'
const app:Application = express()

app.use(cors({
    origin:"*",
    methods: ["GET", "POST", "DELETE", "PUT", "PATCH"]
}));

app.use(express.json())
app.use('/', publicRoutes)
app.use('/appointments', appointmentRoutes)
app.use('/doctors', doctorRoutes)
app.use('/inventory', inventoryRoutes)
app.use('/patients', patientRoutes)
app.use('/work-schedules', workScheduleRoutes)

app.listen(3001, () => console.log('server starts at port 3001'))