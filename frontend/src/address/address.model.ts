export class Address {
    line1: string;
    line2?: string;
    city: string;
    state: string;
    zipcode: string;
    country: string;
    coordinates: Coordinates;

    constructor(data: any) {
        this.line1 = data.line1;
        this.line2 = data.line2;
        this.city = data.city;
        this.state = data.state;
        this.zipcode = data.zipcode;
        this.country = data.country;
        this.coordinates = new Coordinates(data.coordinates);
    }
}

export class Coordinates {
    latitude: string;
    longitude: string;

    constructor(data: any) {
        this.latitude = data.latitude;
        this.longitude = data.longitude;
    }
}

export interface CreateAddressRequest {
    line1: string;
    line2?: string;
    city: string;
    state: string;
    zipcode: string;
    country: string;
    coordinates: Coordinates;
}