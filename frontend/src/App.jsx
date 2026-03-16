import '@/App.css'
import { Routes, Route } from "react-router";
import Home from '@/screens/Home';
import AppLayout from '@/screens/layouts/App';
import InventoryLayout from '@/screens/layouts/Inventory';
import Items from '@/screens/inventory/Items';
import Units from '@/screens/inventory/Units';
import Locations from '@/locations/locations.screen';

import { ScreenProvider } from '@/shared/contexts/screen.context';
import { ThemeProvider } from '@/shared/contexts/theme.context';
import { TooltipProvider } from "@/shared/components/ui/tooltip"
import { AuthProvider } from '@/core/auth/auth.context';
import AuthLayout from '@/core/auth/screens/auth.layout';
import LoginScreen from '@/core/auth/screens/login.screen';
import { ToastProvider } from '@/shared/contexts/toast.context';

function App() {
  return (
    <ThemeProvider>
      <ScreenProvider>
        <ToastProvider>
          <TooltipProvider>
            <AuthProvider>
              <Routes>
                <Route path="/" element={<AuthLayout />}>
                  <Route path="/login" element={<LoginScreen />} />
                </Route>
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
            </AuthProvider>
          </TooltipProvider>
        </ToastProvider>
      </ScreenProvider>
    </ThemeProvider>
  )
}

export default App
