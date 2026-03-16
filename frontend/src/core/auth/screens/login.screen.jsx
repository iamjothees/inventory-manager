import { useState } from "react";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";
import { z } from "zod";
import { Button } from "@/shared/components/ui/button";
import {
    Form,
    FormControl,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from "@/shared/components/ui/form";
import { Input } from "@/shared/components/ui/input";
import { Link, useNavigate } from "react-router";
import useToast from "@/shared/contexts/toast.context";
import useAuth from "@/core/auth/auth.context";
import LoadingText from "@/shared/components/ui/loadingText";
import DevLogin from "@/core/auth/components/devLogin";

// 1. Updated Schema
const formSchema = z.object({
    username: z.string().min(3, { message: "Username must be at least 3 characters" }),
    password: z.string().min(1, { message: "Password is required" }).min(8, { message: "Password must be at least 8 characters" }),
});

export default function Login() {
    const [loading, setLoading] = useState(false);
    const [generalError, setGeneralError] = useState("");
    const { login } = useAuth();

    // 2. Updated Default Values
    const form = useForm({
        resolver: zodResolver(formSchema),
        defaultValues: {
            username: "",
            password: "",
        },
    });

    const navigate = useNavigate();
    const { showToast } = useToast();

    function onSubmit(values) {
        setLoading(true);
        setGeneralError("");

        login(values)
            .then((user) => {
                showToast(`Welcome back! ${user.name}`, "success");
                navigate("/");
            })
            .catch((error) => {
                console.error(error);
                if (error.cause) {
                    setGeneralError(error.message);
                    return;
                }
                showToast("Error logging in. Please try again", "error");
            })
            .finally(() => {
                setLoading(false);
            });
    }

    return (
        <div className="flex-1 container mx-auto flex items-center justify-center px-5">
            <div className="w-full max-w-md space-y-8">
                <div className="text-center">
                    <h2 className="display-text text-3xl">Login</h2>
                    <p className="mt-2 text-muted-foreground">Enter your credentials to continue</p>
                </div>

                <Form {...form}>
                    <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-6">
                        {generalError && (
                            <div className="text-red-500 text-sm text-center">
                                {generalError}
                            </div>
                        )}

                        {/* 3. Updated Username Field */}
                        <FormField
                            control={form.control}
                            name="username"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Username</FormLabel>
                                    <FormControl>
                                        <Input placeholder="johndoe" {...field} disabled={loading} />
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />

                        <FormField
                            control={form.control}
                            name="password"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Password</FormLabel>
                                    <FormControl>
                                        <Input type="password" placeholder="••••••••" {...field} disabled={loading} />
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />

                        <Button type="submit" className="w-full" disabled={loading}>
                            {loading ? <LoadingText text="Signing in" /> : "Sign in"}
                        </Button>
                        {
                            import.meta.env.DEV && (
                                <DevLogin />
                            )
                        }
                    </form>
                </Form>

                <div className="text-center text-sm text-muted-foreground mt-4">
                    <p>Don't have an account? <Link to="/register" className="text-primary hover:underline">Sign up</Link></p>
                </div>
            </div>
        </div>
    );
}