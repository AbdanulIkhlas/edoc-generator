export interface Project {
  id: string;
  title: string;
  shortDescription: string;
  fullDescription: string;
  category: "web-app" | "design-system" | "creative" | "open-source";
  year: string;
  role: string;
  technologies: string[];
  features: string[];
  challenges: string[];
  status: "live" | "in-progress" | "archived";
  links: {
    live?: string;
    github?: string;
    figma?: string;
  };
  featured: boolean;
  image?: string;
}

export const projectsContent = {
  heading: "Projects",
  subheading: "Selected work and experiments",
  filterLabels: {
    all: "All",
    "web-app": "Web Apps",
    "design-system": "Design Systems",
    creative: "Creative",
    "open-source": "Open Source",
  },
};

export const projects: Project[] = [
  {
    id: "momentum-dashboard",
    title: "Momentum Dashboard",
    shortDescription: "A productivity dashboard with analytics, goal tracking, and beautiful data visualizations.",
    fullDescription: "Momentum is a comprehensive productivity dashboard designed to help teams track their goals and visualize progress. Built with a focus on performance and user experience, it features real-time updates, customizable widgets, and a dark mode design system.",
    category: "web-app",
    year: "2024",
    role: "Lead Frontend Developer",
    technologies: ["React", "TypeScript", "Tailwind CSS", "Framer Motion", "Recharts", "Supabase"],
    features: [
      "Real-time data synchronization",
      "Customizable dashboard layouts",
      "Advanced data visualization components",
      "Dark/light mode theming",
      "Keyboard shortcuts and accessibility",
    ],
    challenges: [
      "Implemented virtualized lists for handling 10k+ data points",
      "Created a drag-and-drop widget system with smooth animations",
      "Optimized re-renders using React.memo and useMemo patterns",
    ],
    status: "live",
    links: {
      live: "https://momentum-dash.vercel.app",
      github: "https://github.com/alexchen/momentum",
    },
    featured: true,
  },
  {
    id: "aurora-design-system",
    title: "Aurora Design System",
    shortDescription: "A comprehensive React component library with 50+ accessible components.",
    fullDescription: "Aurora is an open-source design system built from the ground up with accessibility and developer experience in mind. It includes a full suite of components, design tokens, and documentation to help teams build consistent interfaces.",
    category: "design-system",
    year: "2023",
    role: "Creator & Maintainer",
    technologies: ["React", "TypeScript", "Radix UI", "Tailwind CSS", "Storybook", "Turborepo"],
    features: [
      "50+ accessible components",
      "Comprehensive theming system",
      "Interactive Storybook documentation",
      "TypeScript support with full type definitions",
      "Copy-paste ready code snippets",
    ],
    challenges: [
      "Designed flexible API that works for diverse use cases",
      "Ensured WCAG 2.1 AA compliance across all components",
      "Created smooth animations that respect reduced-motion preferences",
    ],
    status: "live",
    links: {
      live: "https://aurora-ui.dev",
      github: "https://github.com/alexchen/aurora-ui",
      figma: "https://figma.com/aurora-design-system",
    },
    featured: true,
  },
  {
    id: "particle-symphony",
    title: "Particle Symphony",
    shortDescription: "An interactive WebGL experience that visualizes music through particles.",
    fullDescription: "A creative coding experiment that transforms audio into visual art. Using Three.js and Web Audio API, it creates mesmerizing particle animations that respond to music in real-time.",
    category: "creative",
    year: "2023",
    role: "Creator",
    technologies: ["Three.js", "WebGL", "Web Audio API", "GLSL Shaders", "React"],
    features: [
      "Real-time audio frequency analysis",
      "Custom GLSL shaders for particle effects",
      "Multiple visualization modes",
      "Microphone input support",
      "Performance optimized for 60fps",
    ],
    challenges: [
      "Optimized particle system for 100k+ particles",
      "Created smooth audio-reactive animations",
      "Handled cross-browser audio context differences",
    ],
    status: "live",
    links: {
      live: "https://particle-symphony.vercel.app",
      github: "https://github.com/alexchen/particle-symphony",
    },
    featured: true,
  },
  {
    id: "react-smooth-scroll",
    title: "React Smooth Scroll",
    shortDescription: "A lightweight React hook for buttery smooth scroll animations.",
    fullDescription: "An open-source React library that provides smooth scrolling animations with minimal configuration. Supports scroll-linked animations, parallax effects, and integrates seamlessly with Framer Motion.",
    category: "open-source",
    year: "2022",
    role: "Creator & Maintainer",
    technologies: ["React", "TypeScript", "Lenis", "Framer Motion"],
    features: [
      "Lightweight bundle (< 3KB gzipped)",
      "Scroll progress tracking",
      "Parallax effect utilities",
      "Framer Motion integration",
      "SSR compatible",
    ],
    challenges: [
      "Ensured consistent behavior across browsers",
      "Optimized for minimal performance impact",
      "Created intuitive API for complex scroll effects",
    ],
    status: "live",
    links: {
      github: "https://github.com/alexchen/react-smooth-scroll",
    },
    featured: false,
  },
  {
    id: "recipe-finder",
    title: "Recipe Finder",
    shortDescription: "A beautiful recipe discovery app with smart filtering and meal planning.",
    fullDescription: "A recipe discovery application that helps users find and save their favorite recipes. Features smart filtering by ingredients, dietary preferences, and cooking time.",
    category: "web-app",
    year: "2022",
    role: "Full Stack Developer",
    technologies: ["Next.js", "TypeScript", "Tailwind CSS", "Prisma", "PostgreSQL"],
    features: [
      "Smart recipe search and filtering",
      "Meal planning calendar",
      "Shopping list generation",
      "User recipe collections",
      "Nutritional information display",
    ],
    challenges: [
      "Implemented efficient full-text search",
      "Created responsive grid layouts for recipe cards",
      "Built intuitive drag-and-drop meal planner",
    ],
    status: "live",
    links: {
      live: "https://recipe-finder.app",
      github: "https://github.com/alexchen/recipe-finder",
    },
    featured: false,
  },
];
