import { work_schedule } from "@prisma/client";

import { z } from "zod";

export const WorkHoursSchema = z.object({
    work_schedule_id: z.number(),
    title: z.string().min(1),
    isArchived: z.boolean(),
    start: z.date(),
    end: z.date(),
    allDay: z.boolean(),
    createdAt: z.date(),
    updatedAt: z.date(),
    doctor_id: z.number(),
  }) satisfies z.ZodType<work_schedule>

  export type WorkHoursSchemaType = z.infer<typeof WorkHoursSchema>

  export const CreateWorkScheduleSchema = WorkHoursSchema.pick({
    title: true,
    start: true,
    end: true,
    allDay: true,
  })

  export type CreateWorkScheduleSchemaType = z.infer<typeof CreateWorkScheduleSchema>
