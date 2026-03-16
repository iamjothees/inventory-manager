import { Address, CreateAddressRequest } from "@/address/address.model";

/* Base Models */
export class Location {
    id: string;
    name: string;
    code: string;
    address: Address;
    contactPersons: ContactPerson[];

    constructor(data: any) {
        this.id = data.id;
        this.name = data.name;
        this.code = data.code;
        this.address = new Address(data.address);
        this.contactPersons = data.contactPersons.map((contact: any) => new ContactPerson(contact));
    }
}

export class ContactPerson {
    id: string;
    name: string;
    phone: string;
    email: string;

    constructor(data: any) {
        this.id = data.id;
        this.name = data.name;
        this.phone = data.phone;
        this.email = data.email;
    }
}

/* Create Request */
export interface CreateLocationRequest {
    name: string;
    code: string;
    address: CreateAddressRequest;
    contactPersons: AttachContactPersons[];
}

interface ExistingPerson {
    id: string;
}

interface NewPerson {
    name: string;
    phone: string;
    email: string;
}

export type AttachContactPersons = ExistingPerson | NewPerson;


/* Update Request */
export interface UpdateLocationRequest {
    name: string;
    code: string;
    address: CreateAddressRequest;
    contactPersons: AttachContactPersons[];
}

export interface UpdateContactPersonRequest {
    id: string;
    name: string;
    phone: string;
    email: string;
}