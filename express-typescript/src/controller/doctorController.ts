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
  
  public getAll = async (req: RequestInterface, res: Response) => {
    try {
    const prisma = new PrismaClient();
                                          // const today = moment.utc(date).tz("Asia/Manila").format();
                                          // console.log(today)
    const doctors = await prisma.doctor.findMany({
      include: {
        work_schedule:true
      }
    })
    return res.status(201).json(doctors);
    } catch (error) {
      console.error(error)
      return res.status(500).json({
        message: 'something went wrong...',
        success:false
      })
    }
  }
}

export default AppointmentController;
