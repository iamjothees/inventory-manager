import { Home, Settings, ScrollText, ScanQrCode, Box } from 'lucide-react'
import { useNavigate } from "react-router";

function NavMenu() {
    let navigate = useNavigate();
    return (
        <footer className="absolute bottom-0 w-full h-20 flex-shrink-0 bg-primary text-white rounded-t-2xl">
            <div className="absolute bottom-0 w-screen h-full flex justify-around items-center py-1">
                <Button icon={<Home size={28} />} onClick={() => navigate("/")} helperText="Home" />
                <Button icon={<Box size={28} />} onClick={() => navigate("/inventory")} helperText="Inventory" />
                <Button icon={<ScanQrCode size={28} />} onClick={() => navigate("/scan")} helperText="Scan" />
                <Button icon={<ScrollText size={28} />} onClick={() => navigate("/add-sale")} helperText="Add Sale" />
                <Button icon={<Settings size={28} />} onClick={() => navigate("/settings")} helperText="Settings" />
            </div>
        </footer>
    )
}

function Button({ icon, onClick = () => { }, helperText }) {
    return (
        <button onClick={onClick} className="hover:bg-primary-foreground hover:text-primary rounded-full p-2 cursor-pointer flex flex-col items-center">
            {icon}
            <span className="text-xs mt-1">{helperText}</span>
        </button>
    )
}

export default NavMenu