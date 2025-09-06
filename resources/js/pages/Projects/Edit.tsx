import { Link, useForm } from '@inertiajs/react'
import type { Project, ProjectStatus } from '@/types'

type Props = { project: Project }

export default function Edit({ project }: Props) {
  const { data, setData, put, processing, errors } = useForm({
    title: project.title ?? '',
    slug: project.slug ?? '',
    city: project.city ?? '',
    area: project.area ?? '',
    bedrooms: project.bedrooms ?? 0,
    size_sqft: project.size_sqft ?? 0,
    price: project.price ?? 0,
    status: (project.status ?? 'draft') as ProjectStatus,
    description: project.description ?? '',
    published_at: project.published_at ? project.published_at.substring(0,16) : ''
  })

  const submit = (e: React.FormEvent) => { e.preventDefault(); put(`/projects/${project.id}`) }

  return (
    <div className="p-6 max-w-2xl">
      <h1 className="text-xl font-bold mb-4">Edit Project</h1>
      <form onSubmit={submit} className="space-y-3">
        <input className="border p-2 w-full" placeholder="Title" value={data.title} onChange={(e)=>setData('title', e.target.value)}/>
        {errors.title && <div className="text-red-600 text-sm">{errors.title}</div>}

        <input className="border p-2 w-full" placeholder="Slug (optional)" value={data.slug} onChange={(e)=>setData('slug', e.target.value)}/>
        <div className="grid grid-cols-2 gap-2">
          <input className="border p-2" placeholder="City" value={data.city} onChange={(e)=>setData('city', e.target.value)}/>
          <input className="border p-2" placeholder="Area" value={data.area} onChange={(e)=>setData('area', e.target.value)}/>
        </div>
        <div className="grid grid-cols-3 gap-2">
          <input type="number" className="border p-2" placeholder="Bedrooms" value={data.bedrooms} onChange={(e)=>setData('bedrooms', Number(e.target.value))}/>
          <input type="number" className="border p-2" placeholder="Size (sqft)" value={data.size_sqft} onChange={(e)=>setData('size_sqft', Number(e.target.value))}/>
          <input type="number" className="border p-2" placeholder="Price" value={data.price} onChange={(e)=>setData('price', Number(e.target.value))}/>
        </div>
        <select className="border p-2" value={data.status} onChange={(e)=>setData('status', e.target.value as ProjectStatus)}>
          <option value="draft">Draft</option>
          <option value="published">Published</option>
        </select>
        <textarea className="border p-2 w-full" rows={5} placeholder="Description" value={data.description} onChange={(e)=>setData('description', e.target.value)}/>
        <input className="border p-2 w-full" type="datetime-local" value={data.published_at} onChange={(e)=>setData('published_at', e.target.value)}/>

        <div className="flex gap-2">
          <button disabled={processing} className="px-3 py-2 bg-black text-white rounded">Update</button>
          <Link href="/projects" className="px-3 py-2 border rounded">Back</Link>
        </div>
      </form>
    </div>
  )
}
