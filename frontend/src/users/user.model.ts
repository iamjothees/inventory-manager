export class UserModel {
    id: string;
    name: string;
    username: string;
    public get initial(): string {
        return this.name.split(' ').slice(0, 2).map((word) => word.charAt(0)).join('');
    }

    constructor(
        id: string,
        name: string,
        username: string,
    ) {
        this.id = id;
        this.name = name;
        this.username = username;

    }

    static fromJson(json: any): UserModel {
        if (!json.id) {
            throw new Error("User ID is required");
        }
        if (!json.name) {
            throw new Error("Name is required");
        }
        if (!json.username) {
            throw new Error("Username is required");
        }

        const user = new UserModel(
            json.id,
            json.name,
            json.username,
        );
        return user;
    }
}