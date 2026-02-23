import { Bell, User } from "lucide-react";

function Home() {
  return (
    <div className='flex-grow-1 h-full m-1'>
      <Header />
    </div>
  )
}

function Header() {
  return (
    <div className='flex justify-between items-baseline gap-2 my-2 mx-2'>
      <div className="bg-accent text-accent-foreground p-3 rounded-2xl border-[0.5px] border-accent-foreground/50">
        <User size={38} />
      </div>


      <div className="bg-accent text-accent-foreground p-3 rounded-2xl border-[0.5px] border-accent-foreground/50">
        <Bell size={24} />
      </div>
    </div>
  )
}

export default Home