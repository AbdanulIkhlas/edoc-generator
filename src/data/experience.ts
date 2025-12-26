export interface Experience {
  id: string;
  role: string;
  company: string;
  companyUrl?: string;
  location: string;
  period: string;
  duration: string;
  type: "full-time" | "contract" | "freelance";
  description: string;
  responsibilities: string[];
  technologies: string[];
  achievements: string[];
  teamSize?: string;
}

export const experienceContent = {
  heading: "Experience",
  subheading: "My professional journey",
};

export const experiences: Experience[] = [
  {
    id: "stellar-labs",
    role: "Senior Frontend Developer",
    company: "Stellar Labs",
    companyUrl: "https://stellarlabs.io",
    location: "San Francisco, CA",
    period: "2022 - Present",
    duration: "2 years",
    type: "full-time",
    description: "Leading frontend development for a SaaS platform serving 50k+ users. Focused on performance optimization and design system architecture.",
    responsibilities: [
      "Architected and implemented a component library used across 5 product teams",
      "Led migration from JavaScript to TypeScript, improving code reliability by 40%",
      "Mentored junior developers through code reviews and pair programming",
      "Collaborated with design team to establish design tokens and accessibility standards",
    ],
    technologies: ["React", "TypeScript", "Next.js", "Tailwind CSS", "Framer Motion", "GraphQL"],
    achievements: [
      "Reduced bundle size by 35% through code splitting and lazy loading",
      "Improved Lighthouse performance score from 62 to 94",
      "Built animation system that reduced motion design implementation time by 60%",
    ],
    teamSize: "12 engineers",
  },
  {
    id: "nova-digital",
    role: "Frontend Developer",
    company: "Nova Digital",
    companyUrl: "https://novadigital.com",
    location: "Remote",
    period: "2020 - 2022",
    duration: "2 years",
    type: "full-time",
    description: "Built interactive web applications for clients in fintech and e-commerce sectors. Specialized in complex data visualizations and responsive interfaces.",
    responsibilities: [
      "Developed responsive web applications for 15+ client projects",
      "Created interactive data visualization dashboards using D3.js and Recharts",
      "Implemented CI/CD pipelines for frontend deployments",
      "Wrote comprehensive documentation for reusable component patterns",
    ],
    technologies: ["React", "Vue.js", "JavaScript", "SCSS", "D3.js", "REST APIs"],
    achievements: [
      "Delivered 3 major projects ahead of schedule",
      "Achieved 98% client satisfaction rating",
      "Reduced development time by 25% through component reuse",
    ],
    teamSize: "6 engineers",
  },
  {
    id: "creative-studio",
    role: "Junior Frontend Developer",
    company: "Creative Studio Co",
    location: "Los Angeles, CA",
    period: "2019 - 2020",
    duration: "1 year",
    type: "full-time",
    description: "Started my professional journey at a creative agency, building marketing websites and landing pages for diverse clients.",
    responsibilities: [
      "Built responsive landing pages and marketing websites",
      "Implemented animations and micro-interactions",
      "Collaborated with designers to ensure pixel-perfect implementations",
      "Maintained and updated existing client websites",
    ],
    technologies: ["HTML", "CSS", "JavaScript", "jQuery", "WordPress", "GSAP"],
    achievements: [
      "Completed 20+ landing page projects",
      "Learned fundamentals of modern frontend development",
      "Received promotion to mid-level within 8 months",
    ],
  },
  {
    id: "freelance",
    role: "Freelance Developer",
    company: "Self-Employed",
    location: "Remote",
    period: "2018 - 2019",
    duration: "1 year",
    type: "freelance",
    description: "Worked with small businesses and startups to build their web presence, focusing on WordPress sites and custom solutions.",
    responsibilities: [
      "Consulted with clients to understand business requirements",
      "Designed and developed custom WordPress themes",
      "Provided ongoing maintenance and support",
      "Managed client relationships and project timelines",
    ],
    technologies: ["WordPress", "PHP", "HTML", "CSS", "JavaScript"],
    achievements: [
      "Built portfolio of 10+ client projects",
      "Maintained 100% project completion rate",
      "Developed client communication and project management skills",
    ],
  },
];
