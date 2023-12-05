import { PrismaClient } from "@prisma/client";
import { Request, Response } from "express";
import jwt from "jsonwebtoken";
import moment from "moment-timezone";
import { RequestInterface } from "../interface/RequestInterface";

class AppointmentController {
  /**
   *
   */
  constructor() {}
  
  public create = async (req: RequestInterface, res: Response) => {
    try {
    const prisma = new PrismaClient();
    const { activeDay, newEvent,eventDoctor } = req.body

    const date = new Date()
    const time = newEvent.time;
    date.setDate(activeDay)
    date.setHours( + time.split(':')[0],  + time.split(':')[1],)

    if(req.user.patient_id) {
      return res.status(400).json({
        message: 'Patient missing',
        success:false
      })
    }

    const appointment = await prisma.appointment.create({
      data: {
        date: date,
        doctor_id:  + eventDoctor,
        description:newEvent.title,
        patient_id: req.user.patient_id
      }
    })
    
    if(!appointment) {
      return res.status(400).json({
        message: 'appointment already exist',
        success:false
      })
    }

    return res.status(201).json(appointment);
    } catch (error) {
      console.error(error)
      return res.status(500).json({
        message: 'internal server error',
        success:false
      })
    }
  }

  public getAll = async (req: RequestInterface, res: Response) => {
    try {
      const prisma = new PrismaClient();
    // const today = moment.utc(date).tz("Asia/Manila").format();
    // console.log(today)

    const appointments = await prisma.appointment.findMany({
      where: {
        patient_id: req.user.patient_id
      }
    })

    return res.status(201).json(appointments);
    } catch (error) {
      console.error(error)
      return res.status(500).json({
        message: 'internal server error',
        success:false
      })
    }
  }

  public getHistoryByDoctor = async (req: RequestInterface, res: Response) => {
    try {
      const prisma = new PrismaClient();
      const doctor_id = req.params.id

      console.log('hitted', doctor_id)
      const today = moment.utc(new Date()).tz("Asia/Manila").format();

          const pastEvents = await prisma.appointment.findMany({
            where: {
              date: {
                lt: today, // "lt" stands for "less than"
              },
              doctor_id:  + doctor_id
            },
            include: {
              patient:true
            }
          });
        return res.status(200).json({
          data: pastEvents,
          success:true
        })
        
    } catch (error) {
      console.error(error)
      return res.status(500).json({
        message: 'internal server error',
        success:false
      })
    }
  }


  public getHistoryAppointment = async (req: RequestInterface, res: Response) => {
    try {
      const prisma = new PrismaClient();
      
      const today = moment.utc(new Date()).tz("Asia/Manila").format();
    console.log(today)
          const pastEvents = await prisma.appointment.findMany({
            where: {
              date: {
                lt: today, // "lt" stands for "less than"
              },
              patient_id: req.user.patient_id
            },
          });
        return res.status(200).json({
          data: pastEvents,
          success:true
        })
        
    } catch (error) {
      console.error(error)
      return res.status(500).json({
        message: 'internal server error',
        success:false
      })
    }
  }


  public updateStatus = async (req: RequestInterface, res: Response) => {
    try {
      const {appointmentId, status, user_id} = req.body;
      console.log(req.body)
      const prisma = new PrismaClient();

      if(!appointmentId || !user_id) {
        return res.status(404).json({
          message: 'Appointment ID or User Id missing',
          success:false
        })
      }

      const appointment = await prisma.appointment.findFirst({
        where: {
          appointment_id: + appointmentId as number 
        }
      })


      const updatedAppointments = await prisma.appointment.update({
        where: {
          appointment_id: appointment?.appointment_id
        },
        data: {
          request_status: status,
          doctor_id: + user_id
        }
      })

      return res.status(201).json(updatedAppointments);
    } catch (error) {
      console.error(error)
      return res.status(500).json({
        message: 'internal server error',
        success:false
      })
    }
  }

  public deleteStatus = async (req: RequestInterface, res: Response) => {
    try {
      const appointmentId = req.params.id
      const prisma = new PrismaClient();

      if(!appointmentId) {
        return res.status(404).json({
          message: 'Appointment ID missing',
          success:false
        })
      }

      const appointment = await prisma.appointment.delete({
        where: {
          appointment_id: + appointmentId as number 
        }
      })

      return res.status(201).json(appointment);
    } catch (error) {
      console.error(error)
      return res.status(500).json({
        message: 'internal server error',
        success:false
      })
    }
  }

}

export default AppointmentController;
