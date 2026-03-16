import { Button } from '@/shared/components/ui/button'
import React from 'react'
import useAuth from '@/core/auth/auth.context';
import { useNavigate } from 'react-router';

function DevLogin() {
    const { login } = useAuth();
    const navigate = useNavigate();
    const users = [
        { username: import.meta.env.VITE_DEV_LOGIN_USERNAME, password: import.meta.env.VITE_DEV_LOGIN_PASSWORD },
    ];

    const handleLogin = (user) => {
        login(user)
            .then(() => {
                navigate("/");
            })
            .catch((error) => {
                console.error(error);
            });
    }


    return (
        <div className="flex flex-col">
            {
                users.map(user => (
                    <Button key={user.username} type="button" onClick={() => handleLogin(user)}>Login AS {user.username}</Button>
                ))
            }
        </div>
    )
}

export default DevLogin;