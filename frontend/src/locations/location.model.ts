import { Address } from "@/address/address.model";

export class Location {
    id: string;
    name: string;
    code: string;
    address: Address;
    contactPersons: ContactPerson[];
}

export class ContactPerson {
    id: string;
    name: string;
    phone: string;
    email: string;
}