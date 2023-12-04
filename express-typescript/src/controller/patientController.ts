import { Request, Response } from "express";
import { PrismaClient } from "@prisma/client";
class PatientController {
  /**
   *
   */
  constructor() {}

  public getDataForDashboard = async (req: Request, res: Response) => {
    try {
    const prisma = new PrismaClient();
    // const patients = await prisma.patient.groupBy({
    //     by: ['barangay_id', ],
    //     _count: {
    //       patient_id:true
    //     },
    //     // orderBy: [{ createdAt: 'asc' }], // Sort by category and then by name
    //   }
    // );

    const barangay: {name:string, count:number}[] = []

    const patients = await prisma.patient.findMany({
      include: {
        barangay:true
      }
    });

    patients.forEach((patient) => {
      const brgyIndex = barangay.findIndex((brgy) => brgy.name === patient.barangay?.name);
      if(brgyIndex == -1 && patient.barangay && patient.barangay.name) {
        barangay.push({
          name: patient.barangay?.name,
          count:1
        })
      }
       else {
        barangay[brgyIndex].count += 1
      }

    })
    
    return res.status(200).json({data:barangay, success: true});
    
    } catch (error) {
      console.error(error)
      return res.status(500).json({message:"internal server error", success: false});
    }
  }
  
}

export default PatientController;
