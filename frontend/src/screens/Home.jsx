import { Bell, User } from "lucide-react";
import useScreen from "@/providers/ScreenProvider";
import { useEffect } from "react";
import { motion } from "motion/react";
import { Avatar, AvatarFallback } from "@/components/ui/avatar"

function Home() {
  const { setTitle, setShowTitle } = useScreen();

  useEffect(() => {
    setTitle('Home');
    setShowTitle(false);
  }, []);

  return (
    <motion.div className='flex-grow-1 h-full m-1'>
      <Header />
    </motion.div>
  )
}

function Header() {
  return (
    <div className='flex justify-between items-baseline gap-2 my-2 mx-2'>
      <Avatar className="w-14 h-14">
        <AvatarFallback>
          <User size={38} />
        </AvatarFallback>
      </Avatar>


      <div className="bg-accent text-accent-foreground p-3 rounded-2xl border-[0.5px] border-accent-foreground/50">
        <Bell size={24} />
      </div>
    </div>
  )
}

export default Home