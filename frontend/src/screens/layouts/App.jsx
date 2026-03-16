import { Outlet, useLocation } from "react-router";
import NavMenu from '@/screens/layouts/app/NavMenu.jsx';
import useScreen from '@/shared/contexts/screen.context.jsx';
import { motion, AnimatePresence } from "motion/react";

const pageVariants = {
    initial: {
        opacity: 0,
        x: "-100vw"
    },
    animate: {
        opacity: 1,
        x: 0
    },
    exit: {
        opacity: 0,
        x: "-100vw"
    }
};

function AppLayout() {
    const location = useLocation();
    const { screen } = useScreen();
    return (
        <div className="flex flex-col w-screen h-dvh bg-background text-foreground max-w-md mx-auto">
            <AnimatePresence mode="wait">
                <motion.div
                    key={location.pathname}
                    variants={pageVariants}
                    initial="initial"
                    animate="animate"
                    exit="exit"
                    transition={{ duration: 0.2 }}

                    drag="x"
                    dragConstraints={{ left: -100, right: 0 }}
                    onDragStart={(event, info) => {
                        Navigate("/inventory")
                    }}

                    className="flex-grow-1 pb-20"
                >
                    <Header />
                    <Outlet />
                </motion.div>
            </AnimatePresence>
            <NavMenu />
        </div>
    )
}

function Header() {
    const { screen } = useScreen();
    return (
        <div className="relative text-center">
            {screen.showTitle && <div className="p-4 text-2xl font-bold text-center">{screen.title}</div>}
            {
                screen.titleAction &&
                <div className="absolute top-0 right-0 p-4 cursor-pointer">{screen.titleAction}</div>
            }
        </div>
    )
}

export default AppLayout