import { Request, Response } from "express";
import { PrismaClient } from "@prisma/client";
import { z } from "zod";
import { CreateWorkScheduleSchema } from "../schema/workSchedules";
import moment from "moment-timezone";

class WorkScheduleController {
  /**
   *
   */
  constructor() {}
  public async get(req: Request, res: Response) {
    try {
      const prisma = new PrismaClient();
      const doctor_id = req.headers.doctor_id;

      if (!doctor_id) {
        return res.status(400).json({
          message: "Doctor ID missing",
          success: false,
        });
      }

      const date = new Date();
      date.setDate(date.getDate() - 1);
      const today = moment.utc(date).tz("Asia/Manila").format();
      const workSchedules = await prisma.work_schedule.findMany({
        where: {
          start: {
            gte: today,
          },
          doctor_id: +doctor_id,
          isArchived: false,
        },
        orderBy: {
          start: "desc",
        },
      });
      console.log(workSchedules);
      return res.status(200).json({
        data: workSchedules,
        success: true,
      });
    } catch (error) {
      console.error(error);
      return res.status(500).json({
        message: "Internal Server Error",
        success: false,
      });
    }
  }
  public async create(req: Request, res: Response) {
    try {
      const prisma = new PrismaClient();
      const doctor_id = req.headers.doctor_id;
      const { work } = req.body;

      if (!doctor_id) {
        return res.status(400).json({
          message: "Doctor ID missing",
          success: false,
        });
      }

      // const result = await CreateWorkScheduleSchema.safeParseAsync(work);

      // if (!result.success) {
      //   return res.status(400).json({
      //     success: false,
      //     errors: result.error.flatten().fieldErrors,
      //     message: "Invalid body parameters",
      //   });
      // }
      // const { title, allDay, end, start } = result.data;
      const { title, allDay, end, start } = work;

      if(!title || !end || !start) {
        return res.status(400).json({
          message: "Title, Start date, End date are required",
          success: false,
        });
      }
      const workSchedule = await prisma.work_schedule.create({
        data: {
          allDay,
          end: new Date(end),
          start: new Date(start),
          title,
          doctor_id: +doctor_id,
        },
      });

      return res.status(200).json({
        data: workSchedule,
        success: true,
      });
    } catch (error) {
      console.error(error);
      return res.status(500).json({
        message: "Internal Server Error",
        success: false,
      });
    }
  }

  public async getAllWorkHours(req: Request, res: Response) {
    try {
      const prisma = new PrismaClient();
      const { activeDay, month, year } = req.body;
      const date = new Date();
      date.setDate(activeDay);
      date.setFullYear(year);
      date.setMonth(month);

      const workSchedules = await prisma.work_schedule.findMany({
        include: {
          doctor:true
        },
        where: {
          start: {
            gte: new Date(
              date.getFullYear(),
              date.getMonth(),
              date.getDate(),
              0,
              0,
              0
            ), // Start of the target day
            lt: new Date(
              date.getFullYear(),
              date.getMonth(),
              date.getDate() + 1,
              0,
              0,
              0
            ), // Start of the next day
          },
        },
      });

      const doctorsAvailable = await prisma.doctor.findMany({
        where:{
          doctor_id: {
            in: workSchedules.map(workSchedule => workSchedule.doctor_id)
          }
        }
      })
      return res.status(200).json({
        data: doctorsAvailable,
        success: true,
      });
    } catch (error) {
      console.error(error);
      return res.status(500).json({
        message: "Internal Server Error",
        success: false,
      });
    }
  }
}

export default WorkScheduleController;