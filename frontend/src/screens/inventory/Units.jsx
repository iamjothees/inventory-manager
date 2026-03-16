import { useEffect } from 'react'
import { useInventoryScreen } from '@/screens/layouts/Inventory';
import { Card, CardContent } from '@/shared/components/ui/card';
import { IceCream2, Icon } from 'lucide-react';

function Units() {
    const { setInventoryScreen } = useInventoryScreen();

    useEffect(() => {
        setInventoryScreen({ title: 'Units', action: { label: 'Add Unit', onClick: () => { } } });
    }, []);
    return (
        <div className='flex flex-col gap-2'>
            {
                Array.from({ length: 50 }).map((_, index) => (
                    <UnitCard key={index} unit={{
                        name: 'Unit ' + index,
                        shortCode: 'UNIT' + index,
                        icon: <IceCream2 size={32} />,
                        conversions: [{
                            type: 'approximate',
                            unit: {
                                name: 'Unit C' + index + 1,
                                shortCode: 'UNITC' + index,
                            },
                            value: 10 * index,
                        }, {
                            type: 'approximate',
                            unit: {
                                name: 'Unit C' + index + 2,
                                shortCode: 'UNITC' + index,
                                icon: <IceCream2 size={32} />,
                            },
                            value: 10 * index,
                        }],
                    }} />
                ))
            }
        </div>
    )
}

export default Units

function UnitCard({ unit }) {
    return (
        <Card className='p-2 rounded-md'>
            <CardContent className='p-0'>
                <div className='flex gap-2 justify-between items-start'>
                    {unit.icon}
                    <h2 className='flex-grow-1 text-lg font-normal'>{unit.name}</h2>
                    <p className='text-sm italic text-foreground/70'>{unit.shortCode}</p>
                </div>
                <div className="text-xs italic text-foreground/70 mt-2">
                    {
                        unit.conversions.map((conversion, index) => (
                            <div key={index} className={`flex gap-2 justify-between items-start ${index === 0 ? 'border-t border-primary/20 pt-1' : ''}`}>
                                1 {unit.shortCode} = {conversion.value} {conversion.unit.shortCode}
                            </div>
                        ))
                    }
                </div>
            </CardContent>
        </Card>
    )
}
