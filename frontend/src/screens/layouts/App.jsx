import React from 'react'
import { Outlet } from "react-router";
import NavMenu from '@/screens/layouts/app/NavMenu.jsx';

function AppLayout() {
    return (
        <div className="flex flex-col w-screen h-dvh bg-background text-foregroundw">
            <div className="flex-grow-1">
                <Outlet />
            </div>
            <NavMenu />
        </div>
    )
}

export default AppLayout