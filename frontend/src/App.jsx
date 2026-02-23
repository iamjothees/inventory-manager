import '@/App.css'
import { Routes, Route } from "react-router";
import Home from '@/screens/Home';
import AppLayout from '@/screens/layouts/App';
import Inventory from '@/screens/Inventory';

function App() {
  return (
    <Routes>
      <Route path="/" element={<AppLayout />}>
        <Route index element={<Home />} />
        <Route path="/inventory" element={<Inventory />} />
      </Route>
    </Routes>
  )
}

export default App
