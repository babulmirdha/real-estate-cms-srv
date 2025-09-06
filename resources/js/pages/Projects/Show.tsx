import { Link } from '@inertiajs/react'
import type { Project } from '@/types'

type Props = { project: Project }

export default function Show({ project }: Props) {
  return (
    <div className="p-6 max-w-3xl">
      <div className="mb-3"><Link href="/projects" className="text-blue-600">← Back</Link></div>
      <h1 className="text-2xl font-bold mb-2">{project.title}</h1>
      <div className="text-sm text-gray-600 mb-4">
        {project.city ?? '—'} • {project.area ?? '—'} • {project.status}
      </div>
      <p className="mb-6 whitespace-pre-line">{project.description ?? '—'}</p>
      <div className="grid grid-cols-3 gap-3 text-sm">
        <div><b>Bedrooms:</b> {project.bedrooms}</div>
        <div><b>Size:</b> {project.size_sqft} sqft</div>
        <div><b>Price:</b> {Number(project.price).toLocaleString()}</div>
      </div>
    </div>
  )
}
