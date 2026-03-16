import React from 'react'
import { Outlet } from 'react-router'

function AuthLayout() {
    return (
        <div className="flex flex-col w-screen h-dvh max-w-md mx-auto bg-background text-foreground">
            <Outlet />
        </div>
    )
}

export default AuthLayout