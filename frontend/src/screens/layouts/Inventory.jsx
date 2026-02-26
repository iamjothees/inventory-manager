import {
    SidebarProvider,
    Sidebar,
    SidebarContent,
    SidebarFooter,
    useSidebar
} from "@/components/ui/sidebar"
import { Outlet, useLocation, useNavigate } from "react-router"
import useScreen from "@/providers/ScreenProvider"
import { useEffect, createContext, useContext, useState } from "react"
import { Button } from "@/components/ui/button"
import { Box, PanelRight, Plus, Scale, Warehouse } from "lucide-react"
import { animate, motion } from "motion/react";

const InventoryScreenContext = createContext();

function InventoryLayout() {
    const { setTitle, setShowTitle } = useScreen();

    const [inventoryScreen, setInventoryScreen] = useState({ title: null, action: null });

    useEffect(() => {
        setTitle("Inventory");
        setShowTitle(true);
    }, []);

    return (
        <InventoryScreenContext.Provider value={{ inventoryScreen, setInventoryScreen }}>
            <SidebarProvider>
                <InventorySidebar />
                <motion.div className="flex-grow-1 mx-2 my-1">
                    {
                        (inventoryScreen.title || inventoryScreen.action) &&
                        <h2 className='text-xl font-normal mb-1'>
                            <div className='flex items-center justify-between'>
                                <span className='ms-1 font-bold'>{inventoryScreen.title}</span>
                                {
                                    inventoryScreen.action && (
                                        <Button variant="outline" size="sm" onClick={inventoryScreen.action.onClick}>
                                            <Plus className="mr-2 h-4 w-4" />
                                            {inventoryScreen.action.label}
                                        </Button>
                                    )
                                }
                            </div>
                        </h2>
                    }
                    <Outlet />
                </motion.div>
            </SidebarProvider>
        </InventoryScreenContext.Provider>
    )
}

export default InventoryLayout

export function useInventoryScreen() {
    return useContext(InventoryScreenContext);
}

function InventorySidebar() {
    const navigate = useNavigate();
    const location = useLocation();
    const { toggleSidebar } = useSidebar();

    const handleOnClick = (path) => {
        toggleSidebar();
        navigate(path);
    }
    return (
        <>
            <div className="absolute top-1 right-0 p-4 cursor-pointer">
                <PanelRight size={32} onClick={() => toggleSidebar()} className="text-primary border border-primary rounded-sm p-1 bg-gray-700/50" />
            </div>
            <Sidebar side="right">
                <SidebarContent className="mt-10 ms-1 me-2">
                    <SidebarItem icon={<Box className="size-6" />} label="Items" onClick={() => handleOnClick("/inventory/items")} active={location.pathname === "/inventory/items"} />
                    <SidebarItem icon={<Scale className="size-6" />} label="Units" onClick={() => handleOnClick("/inventory/units")} active={location.pathname === "/inventory/units"} />
                    <SidebarItem icon={<Warehouse className="size-5" />} label="Locations" onClick={() => handleOnClick("/inventory/locations")} active={location.pathname === "/inventory/locations"} />
                </SidebarContent>
                <SidebarFooter />
            </Sidebar>
        </>
    )
}

function SidebarItem({ icon, label, onClick, active }) {
    return (
        <div onClick={onClick} className={`text-left flex flex-row items-center gap-2 px-2 py-2 m-0 rounded-sm hover:bg-primary/10 ${active ? 'bg-primary/10' : ''}`}>
            {icon}
            <span className="flex-1 text-nowrap text-lg">{label}</span>
        </div>
    )
}
