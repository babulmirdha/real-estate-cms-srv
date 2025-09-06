export type ProjectStatus = 'draft' | 'published'

export interface Project {
  id: number
  title: string
  slug: string
  city?: string | null
  area?: string | null
  bedrooms: number
  size_sqft: number
  price: number
  status: ProjectStatus
  description?: string | null
  published_at?: string | null  // ISO string from Laravel cast
  created_at: string
  updated_at: string
}

// Laravel paginator payload shape that Inertia returns:
export interface PaginatorLink {
  url: string | null
  label: string
  active: boolean
}
export interface Paginator<T> {
  data: T[]
  links: PaginatorLink[]
  current_page: number
  from: number | null
  to: number | null
  total: number
  per_page: number
  last_page: number
  // plus other Laravel fields if you need them…
}
