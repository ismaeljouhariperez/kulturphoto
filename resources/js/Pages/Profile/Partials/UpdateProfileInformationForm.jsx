import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { useForm, usePage } from '@inertiajs/react';
import { Transition } from '@headlessui/react';

export default function UpdateProfileInformation({ className = '' }) {
    const user = usePage().props.auth.user;

    const { data, setData, patch, errors, processing, recentlySuccessful } = useForm({
        name: user.name,
        surname: user.surname,
        nickname: user.nickname,
        address: user.address,
        postal_code: user.postal_code,
        city: user.city,
    });

    const submit = (e) => {
        e.preventDefault();

        patch(route('profile.update'));
    };

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900">Informations de profil</h2>

                <p className="mt-1 text-sm text-gray-600">
                    Mettre à jour les informations de votre compte.
                </p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-6">

                <div>
                    <InputLabel htmlFor="surname" value="Prénom" />

                    <TextInput 
                        id="surname" 
                        className="mt-1 block w-full" 
                        value={data.surname} 
                        onChange={(e) => setData('surname', e.target.value)} 
                        required 
                        autoComplete="surname" />

                    <InputError className="mt-2" message={errors.surname} />
                </div>

                <div>
                    <InputLabel htmlFor="name" value="Nom" />

                    <TextInput
                        id="name"
                        className="mt-1 block w-full"
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
                        required
                        isFocused
                        autoComplete="name"
                    />

                    <InputError className="mt-2" message={errors.name} />
                </div>

                <div>
                    <InputLabel htmlFor="nickname" value="Pseudo" />

                    <TextInput 
                        id="nickname" 
                        className="mt-1 block w-full" 
                        value={data.nickname} 
                        onChange={(e) => setData('nickname', e.target.value)} required autoComplete="nickname" />

                    <InputError className="mt-2" message={errors.nickname} />
                </div>

                <div>
                    <InputLabel htmlFor="address" value="Adresse" />

                    <TextInput 
                        id="address" 
                        className="mt-1 block w-full" 
                        value={data.address} onChange={(e) => setData('address', e.target.value)} 
                        required 
                        autoComplete="address" />

                    <InputError className="mt-2" message={errors.address} />
                </div>
                <div>
                    <InputLabel htmlFor="postal_code" value="Code postal" />

                    <TextInput 
                        id="postal_code" 
                        className="mt-1 block w-full" 
                        value={data.postal_code} onChange={(e) => setData('postal_code', e.target.value)} required 
                        autoComplete="postal_code" />

                    <InputError className="mt-2" message={errors.postal_code} />
                </div>

                <div>
                    <InputLabel htmlFor="city" value="Ville" />

                    <TextInput id="city" 
                        className="mt-1 block w-full" 
                        value={data.city} onChange={(e) => setData('city', e.target.value)}
                        required 
                        autoComplete="city" />

                    <InputError className="mt-2" message={errors.city} />
                </div>

                <div className="flex items-center gap-4">
                    <PrimaryButton disabled={processing}>Enregistrer</PrimaryButton>

                    <Transition
                        show={recentlySuccessful}
                        enter="transition ease-in-out"
                        enterFrom="opacity-0"
                        leave="transition ease-in-out"
                        leaveTo="opacity-0"
                    >
                        <p className="text-sm text-gray-600">Enregistré.</p>
                    </Transition>
                </div>
            </form>
        </section>
    );
}
