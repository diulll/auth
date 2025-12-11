import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Create({ propinsis, users, auth }) {
    const { data, setData, post, processing, errors } = useForm({
        nama_kota: '',
        propinsi_id: '',
        user_id: auth.user.id, // Default to current user
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('kota.store'));
    };

    return (
        <AuthenticatedLayout
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Tambah Kota</h2>}
        >
            <Head title="Tambah Kota" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6">
                            <form onSubmit={submit}>
                                {/* Nama Kota */}
                                <div className="mb-4">
                                    <label htmlFor="nama_kota" className="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Kota
                                    </label>
                                    <input
                                        type="text"
                                        id="nama_kota"
                                        value={data.nama_kota}
                                        onChange={(e) => setData('nama_kota', e.target.value)}
                                        className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Masukkan nama kota"
                                    />
                                    {errors.nama_kota && (
                                        <p className="mt-1 text-sm text-red-600">{errors.nama_kota}</p>
                                    )}
                                </div>

                                {/* Propinsi */}
                                <div className="mb-4">
                                    <label htmlFor="propinsi_id" className="block text-sm font-medium text-gray-700 mb-2">
                                        Propinsi
                                    </label>
                                    <select
                                        id="propinsi_id"
                                        value={data.propinsi_id}
                                        onChange={(e) => setData('propinsi_id', e.target.value)}
                                        className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                        <option value="">--- Pilih propinsi ------</option>
                                        {propinsis.map((prop) => (
                                            <option key={prop.id} value={prop.id}>
                                                {prop.nama_propinsi}
                                            </option>
                                        ))}
                                    </select>
                                    {errors.propinsi_id && (
                                        <p className="mt-1 text-sm text-red-600">{errors.propinsi_id}</p>
                                    )}
                                </div>

                                {/* User ID - Hidden */}
                                <input type="hidden" name="user_id" value={auth.user.id} />

                                {/* Buttons */}
                                <div className="flex items-center gap-4 mt-6">
                                    <button
                                        type="submit"
                                        disabled={processing}
                                        className="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    >
                                        {processing ? 'Menyimpan...' : 'Simpan'}
                                    </button>
                                    <Link
                                        href={route('kota.index')}
                                        className="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                                    >
                                        Batal
                                    </Link>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
