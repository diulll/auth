import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, router } from '@inertiajs/react';

export default function Index({ kota, message, auth }) {
    const handleDelete = (id) => {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            router.delete(route('kota.destroy', id));
        }
    };

    return (
        <AuthenticatedLayout
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">DAFTAR KOTA</h2>}
        >
            <Head title="Daftar Kota" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6">
                            {message && (
                                <div className="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                    {message}
                                </div>
                            )}

                            <div className="mb-4 bg-gray-50 p-4 rounded">
                                <table className="mx-auto">
                                    <tbody>
                                        <tr>
                                            <td className="font-semibold pr-4">User ID</td>
                                            <td>: {auth.user.id}</td>
                                        </tr>
                                        <tr>
                                            <td className="font-semibold pr-4">User Nama</td>
                                            <td>: {auth.user.name}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div className="mb-4">
                                <Link
                                    href={route('kota.create')}
                                    className="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700"
                                >
                                    Tambah Kota
                                </Link>
                            </div>

                            <div className="overflow-x-auto">
                                <table className="min-w-full divide-y divide-gray-200 border">
                                    <thead className="bg-gray-50">
                                        <tr>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border">
                                                ID
                                            </th>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border">
                                                Nama Kota
                                            </th>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border">
                                                Nama Propinsi
                                            </th>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border">
                                                User ID
                                            </th>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border">
                                                User Name
                                            </th>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody className="bg-white divide-y divide-gray-200">
                                        {kota.data && kota.data.length > 0 ? (
                                            kota.data.map((k) => (
                                                <tr key={k.id}>
                                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border">
                                                        {k.id}
                                                    </td>
                                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border">
                                                        {k.nama_kota}
                                                    </td>
                                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border">
                                                        {k.propinsi ? k.propinsi.nama_propinsi : '-'}
                                                    </td>
                                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border">
                                                        {k.user_id}
                                                    </td>
                                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border">
                                                        {k.user ? k.user.name : '-'}
                                                    </td>
                                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border">
                                                        <div className="flex gap-2">
                                                            <Link
                                                                href={route('kota.edit', k.id)}
                                                                className="inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded text-xs text-white uppercase tracking-widest hover:bg-blue-700"
                                                            >
                                                                Edit
                                                            </Link>
                                                            <button
                                                                onClick={() => handleDelete(k.id)}
                                                                className="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded text-xs text-white uppercase tracking-widest hover:bg-red-700"
                                                            >
                                                                Hapus
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            ))
                                        ) : (
                                            <tr>
                                                <td colSpan="6" className="px-6 py-4 text-center text-sm text-gray-500">
                                                    Belum ada data kota
                                                </td>
                                            </tr>
                                        )}
                                    </tbody>
                                </table>
                            </div>

                            {/* Pagination */}
                            {kota.links && kota.links.length > 3 && (
                                <div className="mt-4 flex justify-center gap-1">
                                    {kota.links.map((link, index) => (
                                        <Link
                                            key={index}
                                            href={link.url || '#'}
                                            className={`px-3 py-1 border rounded ${
                                                link.active
                                                    ? 'bg-blue-600 text-white'
                                                    : 'bg-white text-gray-700 hover:bg-gray-100'
                                            } ${!link.url ? 'opacity-50 cursor-not-allowed' : ''}`}
                                            dangerouslySetInnerHTML={{ __html: link.label }}
                                            disabled={!link.url}
                                        />
                                    ))}
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
