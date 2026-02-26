import '@/App.css'
import { Routes, Route } from "react-router";
import Home from '@/screens/Home';
import AppLayout from '@/screens/layouts/App';
import Items from '@/screens/inventory/Items';
import Units from '@/screens/inventory/Units';
import Locations from '@/screens/inventory/Locations';
import { ScreenProvider } from '@/providers/ScreenProvider';
import { ThemeProvider } from '@/providers/ThemePovider';
import { TooltipProvider } from "@/components/ui/tooltip"
import InventoryLayout from '@/screens/layouts/Inventory';

function App() {
  return (
    <ThemeProvider>
      <ScreenProvider>
        <TooltipProvider>
          <Routes>
            <Route path="/" element={<AppLayout />}>
              <Route index element={<Home />} />
              <Route path="/inventory" element={<InventoryLayout />}>
                <Route index element={<Items />} />
                <Route path="items" element={<Items />} />
                <Route path="units" element={<Units />} />
                <Route path="locations" element={<Locations />} />
              </Route>
            </Route>
          </Routes>
        </TooltipProvider>
      </ScreenProvider>
    </ThemeProvider>
  )
}

export default App
