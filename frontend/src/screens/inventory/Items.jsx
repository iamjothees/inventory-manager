import { useEffect, useRef } from 'react'
import { animate, motion } from "motion/react";
import { Card, CardContent } from '@/shared/components/ui/card';
import { formatCurrency } from '@/utils/functions';
import { useInventoryScreen } from '@/screens/layouts/Inventory';


function Items() {
    const { setInventoryScreen } = useInventoryScreen();

    useEffect(() => {
        setInventoryScreen({ title: 'Items', action: { label: 'Add Item', onClick: () => { } } });
    }, []);

    return (
        <div className='flex flex-col gap-2'>
            {
                Array.from({ length: 50 }).map((_, index) => (
                    <ItemCard key={index} item={{
                        name: 'Product ' + index,
                        price: 100 * index,
                        image: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
                    }} />
                ))
            }
        </div>
    )
}

export default Items

function ItemCard({ item }) {
    const ref = useRef(null);
    return (
        <motion.div
            drag="x"
            dragConstraints={{ left: -100, right: 0 }}
            onDragEnd={(event, info) => {
                if (info.offset.x < -50) {
                    console.log('Delete action');
                }
            }}
            onDragStart={() => {
                animate(ref.current, { transform: 'translateX(-100px)' }, { duration: 0.5 })
            }}
            onClick={() => {
                animate(ref.current, { transform: 'translateX(0)' }, { duration: 0.3 })
            }}
            ref={ref}
        >
            <Card className='p-2 rounded-md'>
                <CardContent className='p-0'>
                    <div className='flex gap-2 justify-between items-start'>
                        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt=""
                            className='w-20 h-20 rounded-md flex-shrink-0'
                        />
                        <div className='flex-grow-1'>
                            <h2>{item.name}</h2>
                            <p className='text-sm italic text-foreground/70'>Stock: 10</p>
                        </div>
                        <p className='text-sm italic text-foreground/70'>{formatCurrency(item.price)}</p>
                    </div>
                </CardContent>
            </Card>
        </motion.div>
    )
}