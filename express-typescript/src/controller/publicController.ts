import { Request, Response } from "express";
import { yes } from "../types/yes"; // we could use interface or types extending request
import poolConnection from "../config/connectDb";
import { PrismaClient } from "@prisma/client";
import jwt from "jsonwebtoken";
import bcrypt from 'bcrypt'
class PublicController {
  /**
   *
   */
  constructor() {}
  public indexController = async (req: yes, res: Response): Promise<void> => {
    const [result, _] = await poolConnection.execute(
      "INSERT INTO ts (username, password) VALUES (?, ?)",
      ["jean", "456"]
    );
    req.addNumbers;
    console.log(result);
    res.status(200).json({ name: "andro", age: 50 });
  };

  public register = async (req: Request, res: Response) => {
    try {
      const prisma = new PrismaClient();
     
    const {
      first_name,
      middle_name,
      last_name,
      suffix,
      birthdate,
      contactNo,
      city,
      barangay,
      zip,
      username,
      email,
      password,
      gender,
      homeNo,
      street,
    } = req.body;


    if(!first_name ||
      !last_name ||
      !birthdate ||
      !contactNo ||
      !city ||
      !barangay ||
      !zip ||
      !username ||
      !email ||
      !password ||
      !homeNo ||
      !street ||
      !gender) {
      return res.status(400).json({message:"Fill out all the required fields", success: false});
    }

    if(!/^[A-Za-z\s]*$/.test(first_name) || !/^[A-Za-z\s]*$/.test(last_name) || !/^[A-Za-z\s]*$/.test(last_name) || !/^[A-Za-z\s]*$/.test(suffix)) {
      return res.status(400).json({message:"firstname, lastname, middlename, suffix must have letters only", success: false});
    }
    if(!contactNo.startsWith('0') || (contactNo.length < 11 || contactNo.length > 11)) {
      return res.status(400).json({message:"invalid contact number", success: false});
    }

    if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
      return res.status(400).json({message:"invalid email", success: false});

    }

    if(!/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/.test(password)) {
      return res.status(400).json({message:"invalid password pattern", success: false});
    }
    
    const salt = await bcrypt.genSalt(10)
    const hashPw = await bcrypt.hash(password, salt);
    console.log(req.body)
    const patient = await prisma.patient.create({
      data: {
        first_name,
        middle_name,
        last_name,
        suffix,
        birthdate: new Date(birthdate),
        barangay_id: + barangay,
        contact_number: contactNo,
        street,
        homeNo,
        city,
        zip,
        username: username,
        email,
        password: hashPw,
        gender
      }
    });

    return res.status(200).json({data:patient, success:true});
    
    } catch (error) {
      console.error(error)
      return res.status(500).json({message:"internal server error", success: false});
    }
    
  };

  public login = async (req: Request, res: Response) => {
    try {
      const { username, password } = req.body;
    const prisma = new PrismaClient();

    if (!username || !password) {
      return res.status(400).json({message:"Invalid Credentials", success: false});
    }

    const patient = await prisma.patient.findFirst({
      where: {
        username,
      },
    });

    if (!patient) {
      return res.status(400).json({message:"Invalid Credentials", success: false});
    }

    const isMatch = await bcrypt.compare(password, patient.password);

    if (!isMatch) {
      return res.status(400).json({message:"Invalid Credentials", success: false});

    }
    const maxAge = 24 * 60 * 60;

    const token = jwt.sign({ id: patient.patient_id }, "secret", {
      expiresIn: maxAge,
    });

    return res.status(200).json({token, success: true});
    } catch (error) {
      console.error(error)
      return res.status(500).json({message:"internal server error", success: false});
    }
    
  };

  public getMe = async (req: Request, res: Response) => {
    try {
      const prisma = new PrismaClient();

      const token = req.headers.token;

      if (!token) {
        return res.status(401).json({ message: "Token not Found", success:false });
      }

      const payload = jwt.verify(token as string, "secret") as {
        id: number;
        iat: number;
        exp: number;
      };

      const patient = await prisma.patient.findFirst({
        where: {
          patient_id: payload.id,
        },
      });

      if (!patient) {
        return res.status(401).json({message: 'Patient not found', success:false});
      }

      return res.status(200).json({data:patient, success:true});
    } catch (error) {
      console.error(error)
      return res.status(500).json({message:"internal server error", success: false});
    }
  };
}

export default PublicController;
