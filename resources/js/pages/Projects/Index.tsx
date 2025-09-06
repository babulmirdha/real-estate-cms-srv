import { Link, usePage } from '@inertiajs/react'
import type { Paginator, Project } from '@/types'

type Props = {
  projects: Paginator<Project>
  filters: { term?: string; status?: string; per_page?: number }
}

export default function Index({ projects, filters }: Props) {
  const { flash } = usePage().props as { flash?: { success?: string } }

  return (
    <div className="p-6">
      <div className="flex items-center justify-between mb-4">
        <h1 className="text-xl font-bold">Projects</h1>
        <Link href="/projects/create" className="px-3 py-2 bg-black text-white rounded">New</Link>
      </div>

      <form method="get" className="flex gap-2 mb-4">
        <input name="term" defaultValue={filters.term ?? ''} placeholder="Search…" className="border px-2 py-1 rounded" />
        <select name="status" defaultValue={filters.status ?? ''} className="border px-2 py-1 rounded">
          <option value="">All</option>
          <option value="draft">Draft</option>
          <option value="published">Published</option>
        </select>
        <select name="per_page" defaultValue={String(filters.per_page ?? 10)} className="border px-2 py-1 rounded">
          <option>10</option><option>25</option><option>50</option>
        </select>
        <button className="px-3 py-1 border rounded">Filter</button>
      </form>

      {flash?.success && <div className="mb-3 text-green-700">{flash.success}</div>}

      <table className="w-full text-sm border">
        <thead><tr className="bg-gray-50">
          <th className="p-2 text-left">Title</th>
          <th className="p-2">City</th>
          <th className="p-2">Status</th>
          <th className="p-2">Price</th>
          <th className="p-2"></th>
        </tr></thead>
        <tbody>
          {projects.data.map((p) => (
            <tr key={p.id} className="border-t">
              <td className="p-2"><Link href={`/projects/${p.id}`} className="text-blue-600">{p.title}</Link></td>
              <td className="p-2 text-center">{p.city ?? '-'}</td>
              <td className="p-2 text-center">{p.status}</td>
              <td className="p-2 text-right">{Number(p.price).toLocaleString()}</td>
              <td className="p-2 text-right">
                <Link href={`/projects/${p.id}/edit`} className="px-2 py-1 border rounded mr-2">Edit</Link>
                <Link
                  as="button" method="delete" href={`/projects/${p.id}`}
                  className="px-2 py-1 border rounded"
                  onClick={(e) => { if (!confirm('Delete?')) e.preventDefault() }}
                >
                  Delete
                </Link>
              </td>
            </tr>
          ))}
        </tbody>
      </table>

      <div className="mt-4 flex gap-2">
        {projects.links.map((link) => (
          <Link
            key={link.label + (link.url ?? '')}
            href={link.url ?? '#'}
            dangerouslySetInnerHTML={{ __html: link.label }}
            className={`px-3 py-1 border rounded ${link.active ? 'bg-black text-white' : ''} ${!link.url ? 'opacity-50 pointer-events-none' : ''}`}
          />
        ))}
      </div>
    </div>
  )
}
