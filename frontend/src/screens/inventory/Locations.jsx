import { useEffect } from 'react'
import { useInventoryScreen } from '@/screens/layouts/Inventory';
import { Card, CardContent } from '@/components/ui/card';
import { MapPin, User, Phone } from 'lucide-react';
import { Mail, Globe } from 'lucide-react';
import { Button } from '@/components/ui/button';

function Locations() {
    const { setInventoryScreen } = useInventoryScreen();

    useEffect(() => {
        setInventoryScreen({ title: 'Locations', action: { label: 'Add Location', onClick: () => { } } });
    }, []);
    return (
        <div className='flex flex-col gap-2'>
            {
                Array.from({ length: 3 }).map((_, index) => (
                    <LocationCard key={index} location={{
                        name: 'Location ' + index,
                        code: 'LOC' + index,
                        address: {
                            line1: 'Line 1 ' + index,
                            line2: 'Line 2 ' + index,
                            city: 'City ' + index,
                            state: 'State ' + index,
                            zip: 'Zip ' + index,
                            country: 'Country ' + index,
                            coordinates: {
                                latitude: '11.030480326783893',
                                longitude: '76.9045923781293',
                            }
                        },
                        contactPersons: [
                            {
                                name: 'Contact ' + index,
                                phone: 'Phone ' + index,
                                email: 'Email ' + index,
                            },
                            {
                                name: 'Contact ' + index,
                                phone: 'Phone ' + index,
                                email: 'Email ' + index,
                            },
                        ],
                    }} />
                ))
            }
        </div>
    )
}

export default Locations

function LocationCard({ location }) {
    return (
        <Card className='p-4 rounded-md shadow-sm hover:border-primary/50 transition-colors'>
            <CardContent className='p-0 flex flex-col gap-4'>
                {/* Header Section */}
                <div className='flex justify-between items-start'>
                    <div>
                        <h3 className='text-lg font-bold leading-none'>{location.name}</h3>
                        <p className='text-xs text-muted-foreground mt-1 font-mono uppercase tracking-wider'>
                            {location.code}
                        </p>
                    </div>
                    <Button variant="outline" size="sm" className="text-xs h-8">
                        Edit
                    </Button>
                </div>

                <div className='grid grid-cols-1 md:grid-cols-2 gap-4'>
                    {/* Left: Address Details */}
                    <div className='flex gap-2 text-sm'>
                        <MapPin className='w-4 h-4 mt-0.5 text-muted-foreground shrink-0' />
                        <div className='flex flex-col'>
                            <span className='font-medium'>Address</span>
                            <span className='text-muted-foreground text-xs'>
                                {location.address.line1}, {location.address.line2}<br />
                                {location.address.city}, {location.address.state} {location.address.zip}<br />
                                {location.address.country}
                            </span>
                            <a
                                href={`https://www.google.com/maps?q=${location.address.coordinates.latitude},${location.address.coordinates.longitude}`}
                                target="_blank"
                                className='text-[10px] text-blue-500 hover:underline flex items-center gap-1 mt-1'
                            >
                                <Globe size={18} /> View on Map
                            </a>
                        </div>
                    </div>

                    {/* Right: Contact Persons */}
                    <div className='flex flex-col gap-2'>
                        <span className='text-xs font-semibold flex items-center gap-1'>
                            <User size={24} /> Primary Contacts
                        </span>
                        <div className='flex flex-wrap gap-2'>
                            {location.contactPersons.map((contact, i) => (
                                <div key={i} className='bg-secondary/50 p-2 rounded-sm border w-full lg:w-auto min-w-[200px]'>
                                    <p className='text-xs font-medium'>{contact.name}</p>
                                    <div className='flex flex-col gap-0.5 mt-1'>
                                        <div className='flex items-center gap-2 text-[10px] text-muted-foreground'>
                                            <Phone size={16} /> {contact.phone}
                                        </div>
                                        <div className='flex items-center gap-2 text-[10px] text-muted-foreground'>
                                            <Mail size={16} /> {contact.email}
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </CardContent>
        </Card>
    );
}