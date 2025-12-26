export interface BlogPost {
  id: string;
  title: string;
  excerpt: string;
  content?: string;
  date: string;
  readTime: string;
  tags: string[];
  isPrivate: boolean;
  featured: boolean;
}

export const blogContent = {
  heading: "Blog",
  subheading: "Thoughts, learnings, and explorations",
  privateLabel: "Private",
  requestAccessLabel: "Request Access",
  readMoreLabel: "Read more",
};

export const blogPosts: BlogPost[] = [
  {
    id: "building-design-systems",
    title: "Building Design Systems That Scale",
    excerpt: "Lessons learned from creating a component library used by multiple teams. From tokens to components, here's what actually matters.",
    date: "2024-01-15",
    readTime: "8 min read",
    tags: ["Design Systems", "React", "Architecture"],
    isPrivate: false,
    featured: true,
  },
  {
    id: "animation-principles-web",
    title: "Animation Principles for the Web",
    excerpt: "How to create meaningful animations that enhance user experience without overwhelming. A practical guide to motion design in interfaces.",
    date: "2024-01-02",
    readTime: "6 min read",
    tags: ["Animation", "UX", "Framer Motion"],
    isPrivate: false,
    featured: true,
  },
  {
    id: "typescript-patterns",
    title: "TypeScript Patterns I Use Daily",
    excerpt: "Practical TypeScript patterns that have improved my code quality. From utility types to discriminated unions.",
    date: "2023-12-18",
    readTime: "10 min read",
    tags: ["TypeScript", "JavaScript", "Patterns"],
    isPrivate: false,
    featured: false,
  },
  {
    id: "career-reflections-2023",
    title: "Career Reflections: 2023 in Review",
    excerpt: "A personal reflection on growth, challenges, and learnings from the past year. What worked, what didn't, and what's next.",
    date: "2023-12-28",
    readTime: "5 min read",
    tags: ["Career", "Personal", "Reflection"],
    isPrivate: true,
    featured: false,
  },
  {
    id: "performance-optimization",
    title: "Frontend Performance: Beyond the Basics",
    excerpt: "Moving past Lighthouse scores to real-world performance optimization. Code splitting, lazy loading, and measuring what matters.",
    date: "2023-11-20",
    readTime: "12 min read",
    tags: ["Performance", "React", "Optimization"],
    isPrivate: false,
    featured: false,
  },
  {
    id: "creative-coding-journey",
    title: "My Creative Coding Journey",
    excerpt: "How exploring generative art and creative coding has made me a better frontend developer. The intersection of art and code.",
    date: "2023-10-15",
    readTime: "7 min read",
    tags: ["Creative Coding", "WebGL", "Art"],
    isPrivate: true,
    featured: false,
  },
];

export const whitelist = [
  "friend@example.com",
  "colleague@company.com",
  "mentor@email.com",
];
